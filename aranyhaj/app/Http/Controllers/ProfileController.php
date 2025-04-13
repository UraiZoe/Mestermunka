<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profileImageUpdate(Request $request)
    {
        $request->validate([
            'profileUrlTb' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->image_name = $request->input('profileUrlTb');
        $user->save();

        return redirect()->back()->with('success', 'Profilkép frissítve!');
    }

    public function emailUpdate(Request $request)
    {
        $request->validate([
            'profileEmail' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->email = $request->input('profileEmail');
        $user->save();

        return redirect()->back()->with('success', 'Profil email címe frissítve!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'A jelenlegi jelszó helytelen.']);
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'A jelszó sikeresen módosítva!');
    }

    public function changeAddress(Request $request)
    {
        $request->validate([
            'profileAddress' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->address = $request->input('profileAddress');
        $user->save();

        return redirect()->back()->with('success', 'Profil lakcíme frissítve!');
    }
}