<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class InvoiceController extends Controller
{
    public function sale_invoice(Request $request){
        $bill_no=$request['bill_no'];
        $customer_name=DB::table('sale_item_entries')
            ->join('customers','sale_item_entries.customer_id','customers.id')
            ->where('bill_no',$bill_no)->pluck('cust_name')->first();
        $sale_entries=DB::table('sale_entries')
            ->join('sale_item_entries','sale_entries.bill_no','sale_item_entries.bill_no')
            ->join('items','sale_item_entries.item_id','items.id')
            ->join('units','sale_item_entries.unit_id','units.id')
            ->select('sale_entries.sale_date as sale_date',
                'sale_item_entries.qty as qty','sale_item_entries.price as price',
                'sale_item_entries.bill_no as bill_no','sale_item_entries.totalPrice as totalPrice',
                'items.item_name as item_name',
                'units.unit_name as unit_name')
            ->where('sale_item_entries.bill_no',$bill_no)
            ->get();
        $data=['sale_entries'=>$sale_entries,
            'customer_name'=>$customer_name
        ];
        $pdf = Pdf::loadView('invoice.saleEntryDetails', $data);
        return $pdf->download('saleEntryDetails.pdf');
    }
}
