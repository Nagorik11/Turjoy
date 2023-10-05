<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;


class LoginController extends Controller
{
    //
    
    public function show()
    {
        if(Auth::check()){
            return redirect()->route('home.index');
        }
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        
        $request->validate([
            'email' => 'required|email|not_empty',
            'password' => 'required|not_empty',
        ]);
        $credentials = $request->getCredentials();
      
        if(!Auth::validate($credentials)):
            return redirect()->to('login')
            ->withErrors(trans('auth.failed'));
        endif;
  

        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    protected function authenticated(Request $request, $user) 
    {
        return redirect()->route('home.index');
    }
}
