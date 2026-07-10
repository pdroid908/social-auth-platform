<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Menampilkan halaman register.
     */
    public function create()
    {
        return view('register');
    }

    /**
     * Menyimpan user baru. Regis
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'min:3', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'name' => strip_tags($validated['name']),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }


    /**
     * Menampilkan halaman lOGIN.
     */

    public function loginForm()
    {
    return view('login');
    }

    public function login(Request $request)
    {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    return back()
        ->withErrors([
            'email' => 'Email atau password salah.',
        ])
        ->onlyInput('email');
}
}
