<?php

namespace App\Http\Controllers;

use App\Models\Star;

class HomeController extends Controller
{
    /**
     * Display the homepage with all the Stars.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
     */
    public function index()
    {
        // Get the Stars by last created and paginate them by 10 to avoid overloading.
        $stars = Star::orderByDesc('created_at')
                        ->paginate(6);

        return view('home.index', ['stars' => $stars]);
    }
}
