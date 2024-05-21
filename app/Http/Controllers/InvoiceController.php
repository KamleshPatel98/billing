<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class InvoiceController extends Controller
{
    public function sale_invoice(){
        return $sale_entries=DB::table('sale_entries')
            ->join('sale_item_entries','sale_entries.bill_no','sale_item_entries.bill_no')
            ->join('customers','sale_item_entries.customer_id','customers.id')
            ->join('items','sale_item_entries.item_id','items.id')
            ->join('units','sale_item_entries.unit_id','units.id')
            ->paginate(5);
        //return view('sale.saleEntryDetails',compact('sale_entries'));
    }
}
