@extends('layouts.plantilla')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold"><i class="bi bi-bell me-2 text-info"></i>Alertas</h4>
    <a href="{{ route('alertas.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i> Nueva Alerta
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Evento</th>
                    <th>Usuario</th>
                    <th>Nivel</th>
                    <th>Estado</th>
                    <th>Mensaje</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alertas as $alerta)
                <tr>
                    <td>{{ $alerta->id }}</td>
                    <td>#{{ $alerta->evento->id ?? 'N/A' }} — {{ $alerta->evento->tipo ?? '' }}</td>
                    <td>{{ $alerta->usuario->nombre ?? 'N/A' }}</td>
                    <td>
                        @php
                            $colores = ['baja'=>'success','media'=>'warning','alta'=>'orange','critica'=>'danger'];
                            $color = $colores[$alerta->nivel] ?? 'secondary';
                        @endphp
                        <span class="badge bg-{{ $color }} text-capitalize">{{ $alerta->nivel }}</span>
                    </td>
                    <td>
                        @if($alerta->estado == 'pendiente')
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        @elseif($alerta->estado == 'atendida')
                            <span class="badge bg-success">Atendida</span>
                        @else
                            <span class="badge bg-secondary">Descartada</span>
                        @endif
                    </td>
                    <td>{{ Str::limit($alerta->mensaje, 35) }}</td>
                    <td class="text-center">
                        <a href="{{ route('alertas.show', $alerta->id) }}" class="btn btn-sm btn-info text-white me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('alertas.edit', $alerta->id) }}" class="btn btn-sm btn-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('alertas.destroy', $alerta->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('¿Eliminar esta alerta?')" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">No hay alertas registradas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection