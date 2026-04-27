@extends('layouts.plantilla')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('camaras.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-plus-circle me-2"></i> Nueva Cámara
    </div>
    <div class="card-body">
        <form action="{{ route('camaras.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre') }}" placeholder="Ej: Cámara Entrada Principal">
                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Ubicación</label>
                <input type="text" name="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" value="{{ old('ubicacion') }}" placeholder="Ej: Piso 1 - Puerta Norte">
                @error('ubicacion')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Dirección IP</label>
                <input type="text" name="ip" class="form-control @error('ip') is-invalid @enderror" value="{{ old('ip') }}" placeholder="Ej: 192.168.1.101">
                @error('ip')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Estado</label>
                <select name="estado" class="form-select @error('estado') is-invalid @enderror">
                    <option value="activa" {{ old('estado') == 'activa' ? 'selected' : '' }}>Activa</option>
                    <option value="inactiva" {{ old('estado') == 'inactiva' ? 'selected' : '' }}>Inactiva</option>
                    <option value="falla" {{ old('estado') == 'falla' ? 'selected' : '' }}>Falla</option>
                </select>
                @error('estado')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-save me-1"></i> Guardar Cámara
            </button>
        </form>
    </div>
</div>
@endsection