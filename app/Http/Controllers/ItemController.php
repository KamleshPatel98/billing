<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items=Item::with('category')->paginate(10);
        $categories=Category::all();
        return view('master.item',compact('items','categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $exist=Item::where('item_name',$request['item_name'])->where('category_id',$request['category_id'])->count();
        if($exist>0){
            return back()->with('error','Category In Item Is Already Exists!');
        }else{
            $request->validate(['item_name'=>'required|max:70',
                'category_id'=>'required|exists:categories,id',
                'item_price'=>'required|max:20',
                'item_qty'=>'required|max:11',
                'item_status'=>'nullable|max:1'
            ]);
            try {
                Item::create($request->except('_token'));
                return back()->with('success','Item Added Successfully!');
            } catch (\Exception $ex) {
                //return $ex;
                return back()->with('error','Item Is Not Added!');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        $items=Item::with('category')->paginate(10);
        $categories=Category::all();
        $edit=Item::where('id',$item->id)->get();
        return view('master.item',compact('items','categories','edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        // $exist=Item::where('item_name',$request['item_name'])->where('category_id',$request['category_id'])
        //     ->where('item_price',$request['item_price'])->count();
        // if($exist>0){
        //     return back()->with('error','Category In Item Is Already Exists!');
        // }else{
            $request->validate(['item_name'=>'required|max:70',
                'category_id'=>'required|exists:categories,id',
                'item_price'=>'required|max:20',
                'item_qty'=>'required|max:11',
                'item_status'=>'nullable|max:1']);
            try {
                Item::find($item->id)->update($request->except('_token'));
                return back()->with('success','Item Updated Successfully!');
            } catch (\Exception $ex) {
                //return $ex;
                return back()->with('error','Item Is Not Updated!');
            }
        //}
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        try {
            Item::find($item->id)->delete();
            return back()->with('success','Item Deleted Successfully!');
        } catch (\Exception $ex) {
            return $ex;
            return back()->with('error','Item Is Not Deleted!');
        }
    }
}
