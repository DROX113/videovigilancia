@extends('layouts.plantilla')

@section('contenido')
<div class="mb-4">
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Volver
    </a>
</div>

<div class="card" style="max-width: 600px;">
    <div class="card-header bg-warning">
        <i class="bi bi-pencil me-2"></i> Editar Usuario
    </div>
    <div class="card-body">
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- FOTO --}}
            <div class="mb-3 text-center">
                <img id="preview"
                    src="{{ $usuario->foto ? asset('storage/' . $usuario->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($usuario->nombre) . '&background=0f3460&color=fff&size=100' }}"
                    class="rounded-circle mb-2"
                    style="width:100px; height:100px; object-fit:cover; border: 3px solid #0f3460;">
                <div>
                    <label class="form-label fw-semibold d-block">Cambiar foto de perfil</label>
                    <input type="file" name="foto" id="foto" accept="image/*"
                        class="form-control @error('foto') is-invalid @enderror"
                        onchange="previewImagen(event)">
                    <small class="text-muted">Dejar vacío para mantener la foto actual.</small>
                    @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nombre</label>
                <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror"
                    value="{{ old('nombre', $usuario->nombre) }}">
                @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $usuario->email) }}">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nueva Contraseña <small class="text-muted">(dejar vacío para no cambiar)</small></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    placeholder="Nueva contraseña">
                @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-4">
                <label class="form-label fw-semibold">Rol</label>
                <select name="rol" class="form-select @error('rol') is-invalid @enderror">
                    <option value="visualizador" {{ old('rol', $usuario->rol) == 'visualizador' ? 'selected' : '' }}>Visualizador</option>
                    <option value="operador" {{ old('rol', $usuario->rol) == 'operador' ? 'selected' : '' }}>Operador</option>
                    <option value="admin" {{ old('rol', $usuario->rol) == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('rol')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="btn btn-warning w-100">
                <i class="bi bi-save me-1"></i> Actualizar Usuario
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