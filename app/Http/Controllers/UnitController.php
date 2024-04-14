<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $units=Unit::paginate(10);
        return view('master.unit',compact('units'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['unit_name'=>'unique:units,unit_name|string|required|max:20']);
        try {
            Unit::create($request->except('_token'));
            return back()->with('success','Unit Added Successfully');
        } catch (\Exception $ex) {
            return back()->with('error','Unit Is Not Added');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        $edit=Unit::find($unit->id)->get();
        $units=Unit::paginate(10);
        return view('master.unit',compact('units','edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate(['unit_name'=>'unique:units,unit_name|string|required|max:20']);
        try {
            Unit::find($unit->id)->update($request->except('_token'));
            return back()->with('success','Unit Updated Successfully');
        } catch (\Exception $ex) {
            return back()->with('error','Unit Is Not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        try {
            Unit::find($unit->id)->delete();
            return back()->with('success','Unit Deleted Successfully');
        } catch (\Exception $ex) {
            return back()->with('error','Unit Is Not Deleted');
        }
    }
}
