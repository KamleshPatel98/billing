<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PartyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $parties=Party::query();
        if(!empty($request['party_name'])){
            $party_name=$request['party_name'];
            $parties=$parties->where('party_name','like',"%".$party_name."%");
        }else{
            $party_name='';
        }
        if(!empty($request['party_mobile'])){
            $party_mobile=$request['party_mobile'];
            $parties=$parties->where('party_mobile',$party_mobile);
        }else{
            $party_mobile='';
        }
        $parties=$parties->paginate(10);
        //dd($request['party_name']);
        return view('master.party',compact('parties','party_name','party_mobile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['party_name'=>'required|max:70|string',
        'party_mobile'=>'unique:parties,party_mobile|required|min:10|max:10',
        'party_address'=>'required|string',
        'party_opening_bal'=>'max:11',
        'party_status'=>'required',
        'party_type'=>'required']);
        try {
            Party::create($request->except('_token'));
            return back()->with('success','Party Added Successfully!');
        } catch (\Exception $ex) {
            //return $ex;
            return back()->with('error','Party Is Not Added!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Party $party)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Party $party)
    {
        $edit=Party::find($party->id)->get();
        $parties=Party::paginate(10);
        return view('master.party',compact('parties','edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Party $party)
    {
        $request->validate(['party_name'=>'required|max:70|string',
        'party_mobile'=>['required','min:10','max:10',
            Rule::unique('parties')->ignore($party->id),],
        'party_address'=>'required|string',
        'party_opening_bal'=>'max:20',
        'party_status'=>'required',
        'party_type'=>'required']);
        try {
            Party::find($party->id)->update($request->except('_token'));
            return back()->with('success','Party Updated Successfully!');
        } catch (\Exception $ex) {
            //return $ex;
            return back()->with('error','Party Is Not Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Party $party)
    {
        try {
            Party::find($party->id)->delete();
            return back()->with('success','Party Deleted Successfully!');
        } catch (\Exception $ex) {
            return $ex;
            return back()->with('error','Party Is Not Deleted!');
        }
    }
}
