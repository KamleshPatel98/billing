<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use App\Models\Item;
use App\Models\Unit;
use Illuminate\Http\Request;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!empty($request['purchase_id'])){
            $purchase_items=PurchaseItem::with('item','unit')->where('purchase_id',$request['purchase_id'])->get();
            $grand_total=PurchaseItem::where('purchase_id',$request['purchase_id'])->sum('totalAmount');
        }else{
            $purchase_items=PurchaseItem::with('item','unit')->where('purchase_id','0')->get();
            $grand_total=PurchaseItem::where('purchase_id',0)->sum('totalAmount');
        }
        $html = '';
        foreach ($purchase_items as $row) {
            $html .='
                <tr>
                    <td>'.$row->id.'</td>
                    <td>'.$row->item->item_name.'</td>
                    <td>'.$row->unit->unit_name.'</td>
                    <td>'.$row->price.'</td>
                    <td>'.$row->qty.'</td>
                    <td>'.$row->totalAmount.'</td>
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
                    <th colspan="7">Total Amount :'.$grand_total.' <input type="text" id="purchase_total_amount" value="'.$grand_total.'"></th>
                    
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
    public function storePurchaseLowerEntry(Request $request)
    {
        try {
            $request->validate([
                'item_id'=>'required',
                'unit_id'=>'required',
                'price'=>'required',
                'qty'=>'required',
                'totalAmount'=>'required']);
                PurchaseItem::create($request->all());
            return 200;
        } catch (\Exception $ex) {
            return $ex;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PurchaseItem $puchaseItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editPurchaseItem(Request $request)
    {
        return $item=PurchaseItem::where('id',$request['id'])->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function updatePurchaseItem(Request $request, PurchaseItem $puchaseItem)
    {
        $request->validate([
            'item_id'=>'required',
            'unit_id'=>'required',
            'price'=>'required',
            'qty'=>'required',
            'totalAmount'=>'required']);
        PurchaseItem::where('id',$request['id'])->update($request->except('id'));
        return 200;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletePurchaseItem(Request $request)
    {
        PurchaseItem::where('id',$request['id'])->delete();
        return 200;
    }
}
