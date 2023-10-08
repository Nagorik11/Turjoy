<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

/**
 * Para ejecutar el seeder:
 * php artisan db:seed --class=DefaultUserSeeder
 */
class DefaultUserSeeder extends Seeder
{
    public function run()
    {
        $user = new User();
        $user->name = 'Ítalo Donoso Barraza';
        $user->email = 'italo.donoso@ucn.cl';
        $user->password = Hash::make('Turjoy91'); // Asegúrate de cambiar 'contraseña' por la contraseña deseada
        $user->role = 'Administrador';
        $user->save();
    }


};
