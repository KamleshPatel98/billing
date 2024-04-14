<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class AuthController extends Controller
{
    public function register_form(){
        return view('register');
    }

    public function register(Request $request){
        $request->validate(['name'=>'required|max:70',
        'email'=>'email|required|unique:users,email',
        'password'=>'required|max:12|min:8|confirmed']);

        try {
            User::create(['name'=>$request['name'],
            'email'=>$request['email'],
            'password'=>Hash::make($request['password']),
            '_token'=>$request['_token']]);

            Auth::attempt(['email' => $request['email'], 'password' => $request['password']]);
            return redirect()->route('dashboard')->with('success','User Added Successfully With Login!');;
        } catch (\Exception $ex) {
            //return $ex;
            return back()->with('error','User Is Not Added!');
        }
    }

    public function login_form(){
        return view('login');
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'email|required|exists:users,email',
            'password'=>'required|max:12|min:8']);
        try {
            Auth::attempt(['email' => $request['email'], 'password' => $request['password']]);
            return redirect()->route('dashboard')->with('success','Login Successfully!');;
        } catch (\Exception $ex) {
            return back()->with('error','User Is Not Added!');
        }
    }

    public function logout(){
        Auth::logout();
        session()->flush();
        return redirect()->route('login')->with('success','Logout Successfully!');
    }
}
