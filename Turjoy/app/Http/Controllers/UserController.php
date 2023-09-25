<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    
public function createUser()
{
    $user = new User;
    $user->name = 'admin';
    $user->email = 'admindb@localhost.io';
    $user->password = bcrypt('contraseña'); // Recuerda hashear la contraseña
    $user->save();

    return 'Usuario creado con éxito';
}

}
