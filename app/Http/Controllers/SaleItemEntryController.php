<?php

namespace App\Http\Controllers;

use App\Models\SaleItemEntry;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;

class SaleItemEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salesItems=SaleItemEntry::with('item','unit')->where('sale_item','0')->get();
        
        $html = '';
        
        foreach ($salesItems as $row) {
            
            $html .='
                <tr>
                    <td>'.$row->id.'</td>
                    <td>'.$row->item->item_name.'</td>
                    <td>'.$row->unit->unit_name.'</td>
                    <td>'.$row->price.'</td>
                    <td>'.$row->qty.'</td>
                    <td>'.$row->totalPrice.'</td>
                    <td>'.$row->id.'</td>
                </tr>
            ';
            
        }

        
        //$grandtotal=0;
        $grandTotal=SaleItemEntry::where('sale_item','0')->sum('totalPrice');
    
        $html .='
                <tr>
                    <th colspan="7">Total Amount :'.$grandTotal.'</th>
                </tr>
            ';
        return $html;
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
    public function storeSaleLowerEntry(Request $request)
    {  
        try{
            SaleItemEntry::create($request->all());
            return 200;
        }catch(\Exception $ex){
            return $ex;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SaleItemEntry $saleItemEntry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SaleItemEntry $saleItemEntry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SaleItemEntry $saleItemEntry)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SaleItemEntry $saleItemEntry)
    {
        //
    }
}
