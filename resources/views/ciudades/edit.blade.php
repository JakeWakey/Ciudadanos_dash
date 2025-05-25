@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-bold mb-4">Editar Ciudad</h1>

    <form action="{{ route('ciudades.update', $ciudad) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold">Nombre de la ciudad</label>
            <input type="text" name="name" value="{{ old('name', $ciudad->name) }}" class="w-full border border-gray-300 rounded px-3 py-2" required>
            @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Actualizar</button>
    </form>
</div>
@endsection
