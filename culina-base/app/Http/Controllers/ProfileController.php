<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('profileUser');
    }

    public function updateProfile(ProfileUpdateRequest $request)
    {
        if ($request->password) {
            auth()->user()->update(['password' => Hash::make($request->password)]);
        }

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Use SweetAlert to show success message
        Alert::success('Success', 'Profile updated.');

        return redirect()->back();
    }

}
