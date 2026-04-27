@extends('layouts.plantilla')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-camera-video me-2 text-info"></i>Cámaras</h4>
    <a href="{{ route('camaras.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Nueva Cámara
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>IP</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($camaras as $camara)
                <tr>
                    <td>{{ $camara->id }}</td>
                    <td>{{ $camara->nombre }}</td>
                    <td>{{ $camara->ubicacion }}</td>
                    <td><code>{{ $camara->ip }}</code></td>
                    <td>
                        @if($camara->estado == 'activa')
                            <span class="badge bg-success">Activa</span>
                        @elseif($camara->estado == 'inactiva')
                            <span class="badge bg-secondary">Inactiva</span>
                        @else
                            <span class="badge bg-danger">Falla</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <a href="{{ route('camaras.show', $camara->id) }}" class="btn btn-sm btn-info text-white me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('camaras.edit', $camara->id) }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('camaras.destroy', $camara->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar esta cámara?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">No hay cámaras registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection