<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the homepage with story band and feed preview.
     */
    public function index(): View
    {
        return view('home');
    }
}
