<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Unit;
use App\Models\SaleEntry;
use App\Models\SaleItemEntry;

class SaleEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers=Customer::all();
        $items=Item::all();
        $units=Unit::all();
        $saleEntry=SaleEntry::count();
        $billNo=$saleEntry + 1;
        return view('sale.saleEntry',compact('customers','billNo','items','units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addSaleEntry(Request $request)
    {
        try{
            SaleEntry::create($request->all());
            SaleItemEntry::where('bill_no',$request['bill_no'])->update(['sale_item'=>'1']);
            return 200;
            //return redirect()->back()->with('success','Sale Entry Added Successfully');
        }catch(\Exception $ex){
            return $ex;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleEntry $saleEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleEntry $saleEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleEntry $saleEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleEntry $saleEntry)
    {
        //
    }
}
