<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return View
     */
    public function index(): View
    {
        return view('dashboard');
    }
}