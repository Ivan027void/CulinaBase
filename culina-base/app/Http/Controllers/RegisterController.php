<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Make sure to import the User model

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('regis'); // Replace 'registration' with your actual view name
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required',
            'password' => 'required|confirmed',
        ]);
    
        // Check if all required fields are filled
        if (empty($request->name) || empty($request->email) || empty($request->phone) || empty($request->password)) {
            return redirect('/regis')->with('warning', 'All fields must be filled.');
        }
    
        try {
            // Create a new user
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->password = bcrypt($request->input('password'));
    
            // Check if the email contains "@adm" and assign the role "admin" accordingly
            if (strpos($user->email, '@adm') !== false) {
                $user->role = 'admin';
            }
    
            $user->save();
    
            // You can also automatically log in the user if you want
    
            return redirect('/login')->with('success', 'Registration successful. You can now log in.');
        } catch (\Exception $e) {
            // Handle exceptions, and store the error message in the session
            return redirect('/regis')->with('error', 'Error during registration. Please try again.');
        }
    }
    
}
