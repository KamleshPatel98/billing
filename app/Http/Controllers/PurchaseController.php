<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
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
        $bill_no= $purchase + 1;
        return view('purchase.add',compact('customers','items','units','bill_no'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePurchaseLowerEntry(Request $request)
    {
        try {
            $request->validate(['bill_no'=>'required',
                'item_id'=>'required',
                'unit_id'=>'required',
                'bill_no'=>'required',
                'price'=>'required',
                'qty'=>'required',
                'totalAmount'=>'required']);
            Purchase::create($request->all());
            return 200;
        } catch (\Exception $ex) {
            return $ex;
        }
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
