<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cliente;
use App\Events\UserLoggedIn;
use App\Models\User;



class AuthController extends Controller
{

    /* public function logout()
    {
        $clientes = Cliente::all();
        Auth::logout();
        return view('auth.login', compact('clientes'));
    } */


    public function logout(Request $request)
    {
        Auth::logout();

        //return redirect('/logout'); // Redirige a la ruta /logout después del logout
        return redirect()->route('login');
    }


    public function showLoginForm()
    {
        $clientes = Cliente::all();
        return view('auth.login', compact('clientes'));
    }

    public function login(Request $request)
    {
        // Validar las credenciales del usuario
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Disparar el evento de usuario logueado
            event(new UserLoggedIn(auth()->user()));

            // Redirigir al usuario a la página deseada después de iniciar sesión
            return redirect()->intended('dashboard');
        }

        // Si las credenciales no son válidas, redirigir de nuevo al formulario de inicio de sesión con un mensaje de error
        return back()->withInput($request->only('email'));
    }



}
