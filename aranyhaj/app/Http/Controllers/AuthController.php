<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function register()
    {
        return view('registration');
    }

    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'address' => 'required|string|max:255',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'A felhasználónév megadása kötelező!',
            'email.required' => 'E-mail cím megadása kötelező!',
            'adress.required' => 'Lakcím megadása kötelező!',
            'password.min' => 'A jelszónak legalább 8 karakterből kell állnia!',
        ]);

        $user = new User();
        $user->user_name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->password = Hash::make($request->password);

        $user->save();

        return back()->with('success', 'Sikeres regisztráció! Mostmár bejelentkezhetsz.');
    }

    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $adatok = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($adatok)) {
            return redirect('/')->with('success', 'Sikeres bejelentkezés!');
        }
        return back()->with('error', 'Hibás email cím, vagy jelszó!');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}