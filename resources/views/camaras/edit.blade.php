@extends('layouts.plantilla')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('camaras.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-warning">
        <i class="bi bi-pencil me-2"></i> Editar Cámara
    </div>
    <div class="card-body">
        <form action="{{ route('camaras.update', $camara->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre', $camara->nombre) }}">
                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Ubicación</label>
                <input type="text" name="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" value="{{ old('ubicacion', $camara->ubicacion) }}">
                @error('ubicacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Dirección IP</label>
                <input type="text" name="ip" class="form-control @error('ip') is-invalid @enderror" value="{{ old('ip', $camara->ip) }}">
                @error('ip')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Estado</label>
                <select name="estado" class="form-select @error('estado') is-invalid @enderror">
                    <option value="activa" {{ old('estado', $camara->estado) == 'activa' ? 'selected' : '' }}>Activa</option>
                    <option value="inactiva" {{ old('estado', $camara->estado) == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                    <option value="falla" {{ old('estado', $camara->estado) == 'falla' ? 'selected' : '' }}>Falla</option>
                </select>
                @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-warning w-100">
                <i class="bi bi-save me-1"></i> Actualizar Cámara
            </button>
        </form>
    </div>
</div>
@endsection