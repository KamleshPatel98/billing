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
            ->join('customers','sale_entries.customer_id','customers.id')
            ->join('sale_item_entries','sale_entries.id','sale_item_entries.sale_id')
            ->select('sale_date',
                'sale_id',
                'cust_name')
            ->groupBy('sale_item_entries.sale_id')     
            ->paginate(10);
        return view('sale.saleEntryDetails',compact('sale_entries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addSaleEntry(Request $request)
    {
        try{
            $data = SaleEntry::create($request->all());
            SaleItemEntry::where('sale_id',0)->update(['sale_id'=>$data->id]);
            return 200;
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
    public function editSaleEntry($id)
    {
        $customers=Customer::all();
        $items=Item::all();
        $units=Unit::all();
        $saleEntries=DB::table('sale_entries')
            ->join('sale_item_entries','sale_entries.id','sale_item_entries.sale_id')
            ->where('sale_entries.id',$id)
            ->get();
        return view('sale.editSaleEntry',compact('customers','saleEntries','items','units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateSaleEntry(Request $request, SaleEntry $saleEntry)
    {
        SaleEntry::where('id',$request['id'])->update(['total_amount'=>$request['total_amount']]);
        return 200;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        SaleEntry::where('id',$id)->delete();
        SaleItemEntry::where('sale_id',$id)->delete();
        return back()->with('success','Sale Entry Deleted Successfully!');
    }
}
