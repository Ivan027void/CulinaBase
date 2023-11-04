<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use app\Models\User;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi data input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin' || strpos($user->email, '@adm') !== false) {
                return redirect('/adminPage'); // Redirect to adminPage for admins or emails containing '@adm'
            } else {
                return redirect('/userPage'); // Redirect to userPage for regular users
            }
        }

        return redirect('/login'); // Redirect back to login page if authentication fails
    }


    // Proses logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}