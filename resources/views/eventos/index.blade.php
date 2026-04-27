@extends('layouts.plantilla')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-calendar-event me-2 text-info"></i>Eventos</h4>
    <a href="{{ route('eventos.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Nuevo Evento
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Cámara</th>
                    <th>Tipo</th>
                    <th>Descripción</th>
                    <th>Fecha y Hora</th>
                    <th>Registrado por</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($eventos as $evento)
                <tr>
                    <td>{{ $evento->id }}</td>
                    <td>{{ $evento->camara->nombre ?? 'N/A' }}</td>
                    <td>
                        <span class="badge bg-secondary text-capitalize">{{ $evento->tipo }}</span>
                    </td>
                    <td>{{ Str::limit($evento->descripcion, 40) }}</td>
                    <td>{{ \Carbon\Carbon::parse($evento->fecha_hora)->format('d/m/Y H:i') }}</td>
                    <td>{{ $evento->usuario->nombre ?? 'N/A' }}</td>
                    <td class="text-center">
                        <a href="{{ route('eventos.show', $evento->id) }}" class="btn btn-sm btn-info text-white me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('eventos.edit', $evento->id) }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('eventos.destroy', $evento->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar este evento?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No hay eventos registrados.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection