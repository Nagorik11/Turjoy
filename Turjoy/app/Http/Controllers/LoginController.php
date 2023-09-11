<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        // Validar los datos del formulario
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', // Campo de correo electrónico requerido y debe ser un correo electrónico válido
            'password' => 'required',
        ], [
            'email.required' => 'debe ingresar su correo electrónico para iniciar sesión',
            'email.email' => 'El campo de correo electrónico debe ser un correo electrónico válido',
            'password.required' => 'debe ingresar su contraseña para iniciar sesión',
        ]);

        if ($validator->fails()) {
            // Si la validación falla, redirigir de nuevo a la página de inicio de sesión con los errores
            return redirect('login')
                ->withErrors($validator)
                ->withInput();
        }

       

        $remember = $request->has('remember') ? true : false;
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('privada'));
        } else {
            return redirect('login')
                ->withErrors([
                    'email' => 'usuario no regisrado o contraseña incorrecta',
                ])
                ->withInput();
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('login');
    }
}