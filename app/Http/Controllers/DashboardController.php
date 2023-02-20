<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $complaints = $user->complaint;
        
        return view('pages.dashboard', compact('complaints'));
    }
}
