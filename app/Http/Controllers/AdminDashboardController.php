<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function showAdminDashboardForm()
    {
        return view('auth.admin-dashboard');  // Ensure this view exists
    }
}


