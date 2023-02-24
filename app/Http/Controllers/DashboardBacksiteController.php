<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardBacksiteController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['is_admin', 'is_petugas']);
    // }

    public function index()
    {
        $complaints = Complaint::latest()->paginate(10);
        return view('pages.backsite.dashboard', compact('complaints'));
    }

    public function createResponse()
    {
        return view('pages.backsite.response');
    }
}
