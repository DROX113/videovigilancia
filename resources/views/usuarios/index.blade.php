@extends('layouts.plantilla')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-people me-2 text-info"></i>Usuarios</h4>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Nuevo Usuario
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>
                        <img src="{{ $usuario->foto ? asset('storage/' . $usuario->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($usuario->nombre) . '&background=0f3460&color=fff&size=60' }}"
                            class="rounded-circle"
                            style="width:45px; height:45px; object-fit:cover; border: 2px solid #dee2e6;">
                    </td>
                    <td>{{ $usuario->nombre }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        @if($usuario->rol == 'admin')
                            <span class="badge bg-danger">Admin</span>
                        @elseif($usuario->rol == 'operador')
                            <span class="badge bg-warning text-dark">Operador</span>
                        @else
                            <span class="badge bg-info text-dark">Visualizador</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-sm btn-info text-white me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar este usuario?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No hay usuarios registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection