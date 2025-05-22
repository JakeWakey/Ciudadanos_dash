<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $citiesTotal     = City::count();
        $citizensTotal   = Citizen::count();
        $byCity          = City::withCount('citizens')->orderBy('name')->get();
        return view('dashboard', compact('citiesTotal','citizensTotal','byCity'));
    }
}
