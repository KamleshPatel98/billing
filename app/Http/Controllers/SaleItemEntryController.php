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
    public function index(Request $request)
    {
        if(!empty($request['sale_id'])){
            $salesItems=SaleItemEntry::with('item','unit')->where('sale_id',$request['sale_id'])->get();
            $grandTotal=SaleItemEntry::where('sale_id',$request['sale_id'])->sum('totalPrice');
        }else{
            $salesItems=SaleItemEntry::with('item','unit')->where('sale_id','0')->get();
            $grandTotal=SaleItemEntry::where('sale_id',0)->sum('totalPrice');
        }
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
                    <td> <div class="d-flex justify-content-center">
                    <div class="mr-2">
                        <button type="button" class="btn btn-sm btn-warning edit" value="'. $row->id .'">Edit</button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-danger delete" value="'. $row->id .'">
                            Delete
                        </button>
                    </div>
                </div></td>
                </tr>
            ';
        }
        $html .='
                <tr>
                    <th colspan="7">Total Amount :'.$grandTotal.' <input type="text" id="total_amount" value="'.$grandTotal.'"></th>
                    
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
    public function editItem(Request $request)
    {
        return $item=SaleItemEntry::where('id',$request['id'])->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateItem(Request $request)
    {
        SaleItemEntry::where('id',$request['id'])->update($request->except('id'));
        return 200;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deleteItem(Request $request)
    {
        SaleItemEntry::where('id',$request['id'])->delete();
        return 200;
    }
}
