@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 bg">
        <h1 class="text-2xl font-bold mb-6 text-white">Dashboard de Ciudadanos</h1>

        {{-- Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold">Total de Ciudades</h2>
                <p class="text-3xl font-bold mt-2 text-blue-600">{{ $totalCities }}</p>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold">Total de Ciudadanos</h2>
                <p class="text-3xl font-bold mt-2 text-green-600">{{ $totalCitizens }}</p>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold">Promedio por Ciudad</h2>
                <p class="text-3xl font-bold mt-2 text-purple-600">
                    {{ $totalCities > 0 ? round($totalCitizens / $totalCities, 1) : 0 }}
                </p>
            </div>
        </div>

        {{-- Listado por ciudad --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Ciudadanos por Ciudad</h2>
            <ul class="divide-y divide-gray-200">
                @foreach ($citizensByCity as $city)
                    <li class="py-2 flex justify-between items-center">
                        <span>{{ $city->name }}</span>
                        <span class="font-bold">{{ $city->citizens_count }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
