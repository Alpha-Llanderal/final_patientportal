<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Redirect to the dashboard after login
    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('dashboard'); // Adjust this to your route name
    }

    // Other methods...
}
