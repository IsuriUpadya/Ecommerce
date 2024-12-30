<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class DashboardController extends Controller
{
    public function showDashboardForm()
    {
        return view('auth.dashboard');  // Ensure this view exists
    }

    // public function dashboard()
    // {
    //     return response()->json(auth('api')->user());
    // }
}


