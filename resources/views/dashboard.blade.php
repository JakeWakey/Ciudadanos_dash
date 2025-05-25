@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 bg">
    <div class="flex justify-between items-center flex-row mb-6">
        <h1 class="text-2xl font-bold  text-white">Dashboard de Ciudadanos</h1>
        <a href="/send-report" class="p-4 bg-indigo-600 text-white rounded-md">Mandar reporte de ciudadanos</a>
        </div>

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
    @foreach($citizensWithCity as $cityName => $citizens)
        <li x-data="{ open: false }" class="py-1">

            <!-- Accordion header -->
            <button
                @click="open = !open"
                class="w-full flex justify-between items-center py-2 px-4 bg-white hover:bg-gray-50 focus:outline-none"
            >
                <div class="flex items-center space-x-2">
                    <svg
                        :class="{'rotate-90': open}"
                        class="w-4 h-4 transition-transform"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5l7 7-7 7"/>
                    </svg>
                    <span class="font-medium text-gray-800">{{ $cityName }}</span>
                </div>
                <span class="font-semibold text-gray-900">{{ $citizens->count() }}</span>
            </button>

            <!-- Accordion panel -->
            <div
                x-show="open"
                x-collapse
                class="px-8 py-2 bg-gray-50"
            >
                <ul class="space-y-1">
                    @foreach($citizens as $citizen)
                        <li class="py-1 text-gray-700">
                            {{ $citizen->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
    @endforeach
</ul>
        </div>
    </div>
@endsection
