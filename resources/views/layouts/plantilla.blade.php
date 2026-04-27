<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Videovigilancia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .sidebar {
            min-height: 100vh;
            background-color: #1a1a2e;
            padding-top: 20px;
        }
        .sidebar a {
            color: #a0aec0;
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 8px;
            margin: 4px 10px;
            transition: all 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #0f3460;
            color: #fff;
        }
        .sidebar .nav-title {
            color: #4a5568;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 16px 20px 6px;
        }
        .main-content { padding: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.07); }
        .card-header { border-radius: 12px 12px 0 0 !important; }
        .table th { font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; }
        .badge-activa { background-color: #48bb78; }
        .badge-inactiva { background-color: #a0aec0; }
        .badge-falla { background-color: #fc8181; }
    </style>
</head>
<body>
<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="sidebar" style="width: 240px; min-width: 240px;">
        <div class="text-center mb-4 px-3">
            <h5 class="text-white"><i class="bi bi-camera-video-fill text-info"></i> Vigilancia</h5>
            <small class="text-secondary">Panel de Control</small>
        </div>

        <div class="nav-title">Módulos</div>
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="{{ url('/camaras') }}" class="{{ request()->is('camaras*') ? 'active' : '' }}">
            <i class="bi bi-camera-video me-2"></i> Cámaras~`
        </a>
        <a href="{{ url('/eventos') }}" class="{{ request()->is('eventos*') ? 'active' : '' }}">
            <i class="bi bi-calendar-event me-2"></i> Eventos
        </a>
        <a href="{{ url('/alertas') }}" class="{{ request()->is('alertas*') ? 'active' : '' }}">
            <i class="bi bi-bell me-2"></i> Alertas
        </a>
        <a href="{{ url('/usuarios') }}" class="{{ request()->is('usuarios*') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Usuarios
        </a>
    </div>

    {{-- CONTENIDO PRINCIPAL --}}
    <div class="flex-grow-1">
        {{-- TOPBAR --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
            <span class="navbar-brand">
                <i class="bi bi-shield-lock-fill text-info me-2"></i>
                Sistema de Videovigilancia
            </span>
            <div class="ms-auto text-white-50 small">
                <i class="bi bi-circle-fill text-success me-1" style="font-size:9px"></i>
                Sistema en línea
            </div>
        </nav>

        <div class="main-content">

            {{-- MENSAJES FLASH --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- CONTENIDO DE CADA VISTA --}}
            @yield('contenido')

        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>