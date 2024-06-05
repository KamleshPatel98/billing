<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class InvoiceController extends Controller
{
    public function sale_invoice($sale_id){
        $sale_date=DB::table('sale_entries')->where('id',$sale_id)->pluck('sale_date')->first();
        $customer_name=DB::table('sale_entries')
            ->join('customers','sale_entries.customer_id','customers.id')
            ->where('sale_entries.id',$sale_id)->pluck('cust_name')->first();
        $sale_entries=DB::table('sale_entries')
            ->join('sale_item_entries','sale_entries.id','sale_item_entries.sale_id')
            ->join('items','sale_item_entries.item_id','items.id')
            ->join('units','sale_item_entries.unit_id','units.id')
            ->select(
                'qty','price',
                'sale_id','totalPrice',
                'item_name',
                'unit_name')
            ->where('sale_item_entries.sale_id',$sale_id)
            ->get();
        $data=['sale_entries'=>$sale_entries,
            'customer_name'=>$customer_name,
            'sale_date'=>$sale_date
        ];
        $pdf = Pdf::loadView('invoice.saleEntryDetails', $data);
        return $pdf->download('saleEntryDetails.pdf');
    }
}
