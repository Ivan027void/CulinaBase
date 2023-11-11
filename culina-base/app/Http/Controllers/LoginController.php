<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

            if ($user->isAdmin()) {
                return redirect()->route('admin.page'); // Redirect to adminPage for admins
            } else {
                return redirect()->route('user-page'); // Redirect to userPage for regular users
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