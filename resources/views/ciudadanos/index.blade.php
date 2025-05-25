@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-bold mb-4 text-white">Gestión de Ciudadanos</h1>

    {{-- Formulario de nuevo ciudadano --}}
    <form action="{{ route('ciudadanos.store') }}" method="POST" class="mb-6">
        @csrf
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <input type="text" name="name" placeholder="Nombre..." class="border rounded px-3 py-2 w-full md:w-1/3" required>
            <select name="city_id" class="border rounded px-3 py-2 w-full md:w-1/3" required>
                <option value="">Seleccionar ciudad</option>
                @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Agregar</button>
        </div>
        @error('name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
        @error('city_id') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
    </form>

    {{-- Barra de búsqueda --}}
    <form method="GET" action="{{ route('ciudadanos.index') }}" class="mb-4">
        <input type="text" name="search" value="{{ $search }}" placeholder="Buscar por nombre..."
            class="border rounded px-3 py-2 w-full md:w-1/3">
    </form>

    {{-- Tabla de ciudadanos --}}
    <table class="w-full bg-white shadow rounded table-auto">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">Nombre</th>
                <th class="px-4 py-2 text-left">Ciudad</th>
                <th class="px-4 py-2 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citizens as $citizen)
                <tr class="border-t" data-id="{{ $citizen->id }}">
                    <td class="px-4 py-2">
                        <form action="{{ route('ciudadanos.update', $citizen) }}" method="POST" class="form-edit flex gap-2 items-center w-full">
                            @csrf
                            @method('PUT')
                            <input type="text" name="name" value="{{ $citizen->name }}"
                                class="border px-2 py-1 rounded w-full bg-white" disabled>
                    </td>
                    <td class="px-4 py-2">
                            <select name="city_id" class="border rounded px-2 py-1 bg-white" disabled>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" @selected($citizen->city_id == $city->id)>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                    </td>
                    <td class="px-4 py-2 text-right">
                            <div class="flex gap-2 justify-end">
                                <button type="button" class="text-blue-600 hover:underline edit-btn">Editar</button>
                                <button type="submit" class="text-green-600 hover:underline save-btn hidden">Guardar</button>
                            </div>
                        </form>

                        <form action="{{ route('ciudadanos.destroy', $citizen) }}" method="POST" class="inline delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="text-red-600 hover:underline delete-btn ml-4">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    // Activar edición
    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const form = btn.closest('.form-edit');
            const input = form.querySelector('input[name="name"]');
            const select = form.querySelector('select[name="city_id"]');
            const saveBtn = form.querySelector('.save-btn');

            input.removeAttribute('disabled');
            select.removeAttribute('disabled');
            saveBtn.classList.remove('hidden');
            btn.classList.add('hidden');
            input.focus();
        });
    });

    // Eliminar con SweetAlert
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            Swal.fire({
                title: '¿Eliminar ciudadano?',
                text: "Esta acción no se puede deshacer.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        });
    });

    // Mensajes flash
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: '{{ session('error') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endsection
