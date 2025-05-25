@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-bold mb-4 text-white">Gestión de Ciudades</h1>

    {{-- Agregar ciudad --}}
    <form action="{{ route('ciudades.store') }}" method="POST" id="add-form" class="mb-6 space-y-2">
        @csrf
        <label class="block font-semibold text-white">Nueva Ciudad</label>
        <div class="flex gap-2">
            <input type="text" name="name" class="w-full border rounded px-3 py-2" placeholder="Nombre..." required>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Agregar</button>
        </div>
        @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
    </form>

    {{-- Tabla editable --}}
    <table class="w-full table-auto bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="px-4 py-2 text-left">Nombre</th>
                <th class="px-4 py-2 text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cities as $city)
    <tr class="border-t" data-id="{{ $city->id }}">
        <td class="px-4 py-2">
            <form action="{{ route('ciudades.update', $city) }}" method="POST" class="flex items-center gap-2 form-edit">
                @csrf
                @method('PUT')
                <input type="text" name="name" class="border px-2 py-1 rounded w-full bg-white" value="{{ $city->name }}" disabled>
                <button type="button" class="text-blue-600 hover:underline edit-btn">Editar</button>
                <button type="submit" class="text-green-600 hover:underline save-btn hidden">Guardar</button>
            </form>
        </td>
        <td class="px-4 py-2 text-right">
            <form action="{{ route('ciudades.destroy', $city) }}" method="POST" class="inline delete-form">
                @csrf
                @method('DELETE')
                <button type="button" class="text-red-600 hover:underline delete-btn">Eliminar</button>
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
            const saveBtn = form.querySelector('.save-btn');

            input.removeAttribute('disabled');
            saveBtn.classList.remove('hidden');
            btn.classList.add('hidden');
            input.focus();
        });
    });

    // Confirmación SweetAlert al eliminar
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            Swal.fire({
                title: '¿Estás seguro?',
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

    // Feedback de éxito/error
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
