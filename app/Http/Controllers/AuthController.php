<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => ['required', 'string'],
            'username' => ['required', 'string', 'unique:users,username'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        
        $user = User::create([
            'role_id' => 1,
            'name' => $fields['name'],
            'username' => $fields['username'],
            'password' => bcrypt($fields['password']),
        ]);

        $user->remember_token = $user->createToken('auth_token')->plainTextToken;
        $user->save();

        Auth::login($user);

        return redirect()->route('dashboard')->with('status', 'You are logged now');
    }

    public function showLogin()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // check username
        $user = User::where('username', $fields['username'])->first();

        // check user & password
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return back()->with('error', 'Login failed!');
        }

        // check roles
        if ($user && $user->role_id == 1) {
            $user->remember_token = $user->createToken('auth_token')->plainTextToken;
            $user->save();
            
            Auth::login($user);

            return redirect()->route('dashboard')->with('status', 'You are logged now');
        }

        $user->remember_token = $user->createToken('auth_token')->plainTextToken;
        $user->save();
            
        Auth::login($user);

        return redirect()->route('backsite.dashboard')->with('status', 'You are logged now');

    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        return redirect()->route('index')->withCookie(cookie('remember_token', null, 0))->with('error', 'You are logged out!');
    }
}
