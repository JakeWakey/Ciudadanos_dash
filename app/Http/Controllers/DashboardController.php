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

        $citizensWithCity = Citizen::with('city')
            ->get()
            ->groupBy('city.name')
            ->sortKeys()
            ->map(function($group) {
                return $group->sortBy('name');
             });

        return view('dashboard', compact('totalCities', 'totalCitizens', 'citizensByCity','citizensWithCity'));
    }
}
