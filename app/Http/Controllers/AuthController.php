<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('pages.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'Login' => 'required|unique:users,Login|max:255',
            'Password' => 'required|min:4|confirmed',
        ]);

        $user = User::create([
            'Login' => $request->Login,
            'Password' => Hash::make($request->Password),
            'Role_ID' => 1,
            
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Вы успешно зарегистрированы!');
    }

    public function showLogin()
    {
        return view('pages.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'Login' => 'required',
            'Password' => 'required',
        ]);

        if (Auth::attempt(['Login' => $credentials['Login'], 'password' => $credentials['Password']])) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Вы успешно вошли!');
        }

        return back()->withErrors([
            'Login' => 'Неверный логин или пароль.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}