<?php

namespace App\Http\Controllers\Utilisateur;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }
}
