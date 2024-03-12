<!DOCTYPE html>
<html>
<head>
    <title>Sidebar con Dropdown</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <style>
        /* Estilos para el sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
            padding: 20px;
        }

        /* Estilos para el dropdown */
        .dropdown-menu {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Sidebar</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="#">Inicio</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#">Opción 1</a></li>
                    <li><a class="dropdown-item" href="#">Opción 2</a></li>
                    <li><a class="dropdown-item" href="#">Opción 3</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Otra página</a>
            </li>
        </ul>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4" id="mostrar">
                    <h1>Se va a publicar aqui</h1>
                </main>
        
    </div>

    <div style="position: fixed; bottom: 0; left: 0; right: 0; background-color: #f8f9fa; padding: 20px;">
        <a href="/logout.php" class="btn btn-danger">Cerrar sesión</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>