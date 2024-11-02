<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empleado;

class EmpleadoAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.empleados-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('empleados')->attempt($credentials)) {
            return redirect()->intended('/empleados/dashboard');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('empleados')->logout();
        return redirect('/');
    }

    public function dashboard()
    {
        return view('empleados.dashboard');
    }
}
