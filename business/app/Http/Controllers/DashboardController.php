<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // This method should simply return the dashboard view for everyone.
        return view('dashboard');
    }
}