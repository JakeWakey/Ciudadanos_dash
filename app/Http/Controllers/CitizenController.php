<?php

namespace App\Http\Controllers;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Citizen;

class CitizenController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $citizens = Citizen::with('city')
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->orderBy('name')
            ->get();

        $cities = City::orderBy('name')->get();

        return view('ciudadanos.index', compact('citizens', 'cities', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'city_id' => 'required|exists:cities,id'
        ]);

        Citizen::create($request->all());

        return redirect()->route('ciudadanos.index')->with('success', 'Ciudadano agregado.');
    }

    public function update(Request $request, Citizen $ciudadano)
    {
        $request->validate([
            'name' => 'required|max:255',
            'city_id' => 'required|exists:cities,id'
        ]);

        $ciudadano->update($request->all());

        return redirect()->route('ciudadanos.index')->with('success', 'Ciudadano actualizado.');
    }

    public function destroy(Citizen $ciudadano)
    {
        $ciudadano->delete();

        return redirect()->route('ciudadanos.index')->with('success', 'Ciudadano eliminado.');
    }

}
