<?php

namespace App\Http\Controllers\Dash;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::guard('admin')->attempt($request->validated())) {
            return back()->withErrors('email or password is not correct');
        }

        return to_route('dash.index');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return to_route('dash.loginForm');
    }
}
