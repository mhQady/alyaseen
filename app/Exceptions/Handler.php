<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Auth\AuthenticationException;

class Handler extends Exception
{
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }

        $guard = Arr::get($exception->guards(), 0);

        $login = match ($guard) {
            'admin' => 'dash.login',
            default => 'home'
        };

        return redirect()->guest(route($login));
    }
}
