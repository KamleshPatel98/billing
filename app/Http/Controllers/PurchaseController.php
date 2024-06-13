<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\PurchaseItem;
use App\Models\Customer;
use App\Models\Unit;
use App\Models\Item;
use Illuminate\Http\Request;

class PurchaseController extends Controller
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
    public function purchaseEntry()
    {
        $customers=Customer::all();
        $items=Item::all();
        $units=Unit::all();
        $purchase=Purchase::count();
        $sale_id= $purchase + 1;
        return view('purchase.add',compact('customers','items','units','sale_id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePurchase(Request $request){
        $request->validate(['purchase_date'=>'required|date',
            'customer_id'=>'required',
            'purchase_total_amount'=>'required']);
        $data=Purchase::create($request->all());
        PurchaseItem::where('purchase_id',0)->update(['purchase_id'=>$data->id]);
        return 200;
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
