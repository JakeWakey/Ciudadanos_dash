<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\City;

class CityController extends Controller
{

    public function index()
    {
        $cities = City::orderBy('name')->get();
        return view('ciudades.index', compact('cities'));
    }

    public function create()
    {
        return view('ciudades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:cities,name|max:255'
        ]);

        City::create($request->all());
        return redirect()->route('ciudades.index')->with('success', 'Ciudad creada correctamente.');
    }

    public function edit(City $ciudad)
    {
        return view('ciudades.edit', ['ciudad' => $ciudad]);
    }

    public function update(Request $request, City $ciudad)
    {
        $request->validate([
            'name' => 'required|max:255|unique:cities,name,' . $ciudad->id
        ]);

        $ciudad->update($request->all());
        return redirect()->route('ciudades.index')->with('success', 'Ciudad actualizada.');
    }

    public function destroy(City $ciudad)
    {
        if ($ciudad->citizens()->exists()) {
            return redirect()->route('ciudades.index')->with('error', 'No se puede eliminar una ciudad con ciudadanos.');
        }

        $ciudad->delete();
        return redirect()->route('ciudades.index')->with('success', 'Ciudad eliminada.');
    }

}
