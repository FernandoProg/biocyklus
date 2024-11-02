<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizacionAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.organizaciones-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('organizacion')->attempt($request->only('email', 'password'))) {
            return redirect()->intended('/organizaciones/dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('organizacion')->logout();
        return redirect()->route('organizaciones.login');
    }
}
