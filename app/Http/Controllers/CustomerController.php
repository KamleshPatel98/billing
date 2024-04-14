<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
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
    public function create(Request $request )
    {
        $customers=Customer::query();
        if(!empty($request['cust_name'])){
            $cust_name=$request['cust_name'];
            $customers=$customers->where('cust_name','like',"%".$cust_name."%");
        }else{
            $cust_name='';
        }
        if(!empty($request['mobile'])){
            $mobile=$request['mobile'];
            $customers=$customers->where('mobile',$mobile);
        }else{
            $mobile='';
        }
        $customers=$customers->paginate(10);
        //dd($customers);
        return view('master.customer',compact('customers','cust_name','mobile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['cust_name'=>'required|max:70|string',
            'mobile'=>'unique:customers,mobile|required|min:10|max:10',
            'address'=>'required|string',
            'opening_bal'=>'max:20']);
        try {
            Customer::create($request->except('_token'));
            return back()->with('success','Customer Added Successfully!');
        } catch (\Exception $ex) {
            //return $ex;
            return back()->with('error','Customer Is Not Added!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $edit=Customer::find($customer->id)->get();
        $customers=Customer::paginate(10);
        return view('master.customer',compact('customers','edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate(['cust_name'=>'required|max:70|string',
            'mobile'=>['required','min:10','max:10',
                Rule::unique('customers')->ignore($customer->id),],
            'address'=>'required|string',
            'opening_bal'=>'max:20']);
        try {
            Customer::find($customer->id)->update($request->except('_token'));
            return back()->with('success','Customer Updated Successfully!');
        } catch (\Exception $ex) {
            //return $ex;
            return back()->with('error','Customer Is Not Updated!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        try {
            Customer::find($customer->id)->delete();
            return back()->with('success','Customer Deleted Successfully!');
        } catch (\Exception $ex) {
            return $ex;
            return back()->with('error','Customer Is Not Deleted!');
        }
    }
}
