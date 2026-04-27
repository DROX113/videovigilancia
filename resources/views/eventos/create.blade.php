@extends('layouts.plantilla')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('eventos.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-plus-circle me-2"></i> Nuevo Evento
    </div>
    <div class="card-body">
        <form action="{{ route('eventos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Cámara</label>
                <select name="camara_id" class="form-select @error('camara_id') is-invalid @enderror">
                    <option value="">-- Seleccionar cámara --</option>
                    @foreach($camaras as $camara)
                        <option value="{{ $camara->id }}" {{ old('camara_id') == $camara->id ? 'selected' : '' }}>
                            {{ $camara->nombre }} — {{ $camara->ubicacion }}
                        </option>
                    @endforeach
                </select>
                @error('camara_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Usuario que registra</label>
                <select name="usuario_id" class="form-select @error('usuario_id') is-invalid @enderror">
                    <option value="">-- Seleccionar usuario --</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}" {{ old('usuario_id') == $usuario->id ? 'selected' : '' }}>
                            {{ $usuario->nombre }}
                        </option>
                    @endforeach
                </select>
                @error('usuario_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Tipo de Evento</label>
                <select name="tipo" class="form-select @error('tipo') is-invalid @enderror">
                    <option value="">-- Seleccionar tipo --</option>
                    <option value="movimiento" {{ old('tipo') == 'movimiento' ? 'selected' : '' }}>Movimiento</option>
                    <option value="intrusion" {{ old('tipo') == 'intrusion' ? 'selected' : '' }}>Intrusión</option>
                    <option value="sabotaje" {{ old('tipo') == 'sabotaje' ? 'selected' : '' }}>Sabotaje</option>
                    <option value="otro" {{ old('tipo') == 'otro' ? 'selected' : '' }}>Otro</option>
                </select>
                @error('tipo')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Descripción</label>
                <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="3" placeholder="Describe el evento...">{{ old('descripcion') }}</textarea>
                @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Fecha y Hora</label>
                <input type="datetime-local" name="fecha_hora" class="form-control @error('fecha_hora') is-invalid @enderror" value="{{ old('fecha_hora') }}">
                @error('fecha_hora')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-save me-1"></i> Guardar Evento
            </button>
        </form>
    </div>
</div>
@endsection