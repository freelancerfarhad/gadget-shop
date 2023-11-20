<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function DashboardPage():View{
        return view('pages.dashboard.dashboard-page');
    }
}
