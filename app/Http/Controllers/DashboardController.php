<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Citizen;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index() {
        $totalCities = City::count();
        $totalCitizens = Citizen::count();
        $citizensByCity = City::withCount('citizens')->orderBy('name')->get();

        return view('dashboard', compact('totalCities', 'totalCitizens', 'citizensByCity'));
    }
}
