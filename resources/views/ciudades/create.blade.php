@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-bold mb-4 text-white">Nueva Ciudad</h1>

    <form action="{{ route('ciudades.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label class="block font-semibold text-white">Nombre de la ciudad</label>
            <input type="text" name="name" class="w-full border border-gray-300 rounded px-3 py-2" required>
            @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
    </form>
</div>
@endsection
