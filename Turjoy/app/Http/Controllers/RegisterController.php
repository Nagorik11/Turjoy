<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    /**
     * Show the register form.
     * 
     */

    public function show(){
        if(Auth::check()){
            return redirect()->route('home.index');
        }
        return view('auth.register');
    }
    /**
        * Handle the register form submission.
        * 
        */
    public function register(RegisterRequest $request){
        
        $user = User::create($request->validated());
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->setPassword($request->password);
        $user->role = ($request->role);
        $user->save();
        return redirect('/login')->with('success', "Account successfully registered.");

    }
}
