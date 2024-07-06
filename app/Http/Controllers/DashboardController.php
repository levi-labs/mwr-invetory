<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Welcome to Dashboard';


        return view('pages.dashboard.index', compact('title'));
    }
}
