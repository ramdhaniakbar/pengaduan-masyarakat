<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $user = auth()->user();
    //     dd($user);
    // }

    public function index()
    {
        $role_id = auth()->user()->role_id;
        if ($role_id !== 1) {
            return back()->with('error', 'You do not have access');
        }
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $complaints = $user->complaint()->paginate(10);
        
        return view('pages.dashboard', compact('complaints'));
    }
}
