<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Hash;

class AuthController extends Controller
{
    public function register_form(){
        return view('register');
    }

    public function register(User $user){
        $user->validate(['username'=>'required|max:70',
        'user_email'=>'email|required|unique:users,email',
        'password'=>'required|max:12|min:8|confirmed']);

        try {
            User::create(['username'=>$user['username'],
            'user_email'=>$user['user_email'],
            'password'=>Hash::make($user['password']) ]);
        } catch (\Throwable $th) {
            //throw $th;    
        }
        
        return view('register');
    }
}
