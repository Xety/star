<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    /**
     * Display the dashboard homepage with all the stars.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        return view('dashboard');
    }
}
