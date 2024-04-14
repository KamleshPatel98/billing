<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
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
        $categories=Category::paginate(10);
        return view('master.category',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['category_name'=>'required|max:70|unique:categories,category_name']);
        try {
            Category::create($request->except('_token'));
            return back()->with('success','Category Added Successfully!');
        } catch (\Exception $ex) {
            return back()->with('error','Category Is Not Added!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $categories=Category::paginate(10);
        $edit=Category::find($category->id)->get();
        return view('master.category',compact('categories','edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate(['category_name'=>'required|max:70|unique:categories,category_name']);
        try {
            Category::find($category->id)->update($request->except('_token'));
            return back()->with('success','Category Updated Successfully!');
        } catch (\Exception $ex) {
            return back()->with('error','Category Is Not Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            Category::find($category->id)->delete();
            return back()->with('success','Category Deleted Successfully!');
        } catch (\Exception $ex) {
            return back()->with('error','Category Is Not Deleted!');
        }
    }
}
