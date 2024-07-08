<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $title = 'Login';
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('pages.auth.login', compact('title'));
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            if (auth()->attempt(['username' => $request->username, 'password' => $request->password])) {
                return redirect()->route('dashboard')->with('success', 'Login successful');
            } else {
                return redirect()->back()->with('error', 'Invalid username or password');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function editPassword()
    {
        $title = 'Change Password';
        return view('pages.auth.change-password', compact('title'));
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        $oldPassword = auth()->user()->password;
        $id = auth()->user()->id;
        $inputOldPassword = $request->old_password;
        $newPassword = $request->new_password;

        try {
            if (!Hash::check($inputOldPassword, $oldPassword)) {
                return redirect()->back()->with('error', 'Old password does not match');
            } else {
                User::where('id', $id)->update(['password' => bcrypt($newPassword)]);
                return redirect()->back()->with('success', 'Password changed successfully');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success', 'Logout successful');
    }
}
