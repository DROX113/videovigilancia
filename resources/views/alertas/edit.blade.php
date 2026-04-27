@extends('layouts.plantilla')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('alertas.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-warning">
        <i class="bi bi-pencil me-2"></i> Editar Alerta
    </div>
    <div class="card-body">
        <form action="{{ route('alertas.update', $alerta->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Evento</label>
                <select name="evento_id" class="form-select @error('evento_id') is-invalid @enderror">
                    <option value="">-- Seleccionar evento --</option>
                    @foreach($eventos as $evento)
                        <option value="{{ $evento->id }}" {{ old('evento_id', $alerta->evento_id) == $evento->id ? 'selected' : '' }}>
                            #{{ $evento->id }} — {{ $evento->tipo }} ({{ $evento->camara->nombre ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
                @error('evento_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Usuario a notificar</label>
                <select name="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror">
                    <option value="">-- Seleccionar usuario --</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('usuario_id', $alerta->usuario_id) == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('usuario_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nivel</label>
                <select name="nivel" class="form-select @error('nivel') is-invalid @enderror">
                    <option value="baja" {{ old('nivel', $alerta->nivel) == 'baja' ? 'selected' : '' }}>Baja</option>
                    <option value="media" {{ old('nivel', $alerta->nivel) == 'media' ? 'selected' : '' }}>Media</option>
                    <option value="alta" {{ old('nivel', $alerta->nivel) == 'alta' ? 'selected' : '' }}>Alta</option>
                    <option value="critica" {{ old('nivel', $alerta->nivel) == 'critica' ? 'selected' : '' }}>Crítica</option>
                </select>
                @error('nivel')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Estado</label>
                <select name="estado" class="form-select @error('estado') is-invalid @enderror">
                    <option value="pendiente" {{ old('estado', $alerta->estado) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="atendida" {{ old('estado', $alerta->estado) == 'atendida' ? 'selected' : '' }}>Atendida</option>
                    <option value="descartada" {{ old('estado', $alerta->estado) == 'descartada' ? 'selected' : '' }}>Descartada</option>
                </select>
                @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Mensaje</label>
                <textarea name="mensaje" class="form-control @error('mensaje') is-invalid @enderror" rows="3">{{ old('mensaje', $alerta->mensaje) }}</textarea>
                @error('mensaje')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-warning w-100">
                <i class="bi bi-save me-1"></i> Actualizar Alerta
            </button>
        </form>
    </div>
</div>
@endsection