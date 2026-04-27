@extends('layouts.plantilla')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-primary text-white">
        <i class="bi bi-plus-circle me-2"></i> Nuevo Usuario
    </div>
    <div class="card-body">
        <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- FOTO --}}
            <div class="mb-3 text-center">
                <img id="preview" src="https://ui-avatars.com/api/?name=Usuario&background=0f3460&color=fff&size=100"
                    class="rounded-circle mb-2"
                    style="width:100px; height:100px; object-fit:cover; border: 3px solid #0f3460;">
                <div>
                    <label class="form-label fw-semibold d-block">Foto de perfil</label>
                    <input type="file" name="foto" id="foto" accept="image/*"
                        class="form-control @error('foto') is-invalid @enderror"
                        onchange="previewImagen(event)">
                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre') }}" placeholder="Nombre completo">
                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" placeholder="correo@ejemplo.com">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Contraseña</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Mínimo 8 caracteres">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Rol</label>
                <select name="rol" class="form-select @error('rol') is-invalid @enderror">
                    <option value="visualizador" {{ old('rol') == 'visualizador' ? 'selected' : '' }}>Visualizador</option>
                    <option value="operador" {{ old('rol') == 'operador' ? 'selected' : '' }}>Operador</option>
                    <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('rol')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-save me-1"></i> Guardar Usuario
            </button>
        </form>
    </div>
</div>

<script>
function previewImagen(event) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('preview').src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>
@endsection