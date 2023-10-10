<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Http\controller\LoginController;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if(! $request->expectsJson()){
<<<<<<< HEAD
            return route('home.index');
=======
            return route('login.show');
>>>>>>> 81f025e720e23d3ef07d6e093f54eeb2078857b5
        }
        //return $request->expectsJson() ? null : route('login');
    }
}
