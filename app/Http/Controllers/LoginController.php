<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AuthMid;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $middleware = new AuthMid();
        
        return $middleware->handle($request, function () {
            return redirect()->route('dashboard');
        });
    }

}
