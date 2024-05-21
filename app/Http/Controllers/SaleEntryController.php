<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Item;
use App\Models\Unit;
use App\Models\SaleEntry;
use App\Models\SaleItemEntry;
use DB;

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
    public function saleEntryDetails()
    {
        $sale_entries=DB::table('sale_entries')
            ->join('sale_item_entries','sale_entries.bill_no','sale_item_entries.bill_no')
            ->join('customers','sale_item_entries.customer_id','customers.id')
            ->join('items','sale_item_entries.item_id','items.id')
            ->join('units','sale_item_entries.unit_id','units.id')
            ->select('sale_entries.sale_date as sale_date',
                'sale_item_entries.qty as qty','sale_item_entries.totalPrice as totalPrice','sale_item_entries.price as price',
                'sale_item_entries.bill_no as bill_no',
                'customers.cust_name as cust_name','units.unit_name as unit_name','items.item_name as item_name')
            ->paginate(5);
        return view('sale.saleEntryDetails',compact('sale_entries'));
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
