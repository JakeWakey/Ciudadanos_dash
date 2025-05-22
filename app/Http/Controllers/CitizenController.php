<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CitizenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $collection = Citizen::with('city')
            ->when($req->q, fn($q)=>$q->where('name','like',"%$req->q%"))
            ->when($req->city, fn($q)=>$q->whereHas('city',
                   fn($q2)=>$q2->where('name','like',"%{$req->city}%")))
            ->orderBy('name')
            ->paginate(15)->withQueryString();
        return view('citizens.index', ['citizens'=>$collection]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
