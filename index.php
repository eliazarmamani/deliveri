<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestión - Restaurante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2 bg-light sidebar py-4">
                <!--  Sidebar -->
                <div class="text-center mb-4">
                    <h4>Pizzería</h4>
                    <p>Sistema de Gestión</p>
                </div>
                <nav class="nav flex-column">
                    <a class="nav-link active" href="index.php">
                        <i class="bi bi-speedometer2"></i> 
                        Dashboard
                    </a>
                    <a class="nav-link" href="clientes/index.php">
                        <i class="bi bi-people"></i> 
                        Clientes
                    </a>
                    <a class="nav-link" href="productos/index.php">
                        <i class="bi bi-box"></i> 
                        Productos
                    </a>
                    <a class="nav-link" href="pedidos/index.php">
                        <i class="bi bi-cart3"></i> 
                        Pedidos
                    </a>
                </nav>
            </div>
            <div class="col-10 py-4 px-4">
                <!-- Contenido Principal -->
                <h1 class="mb-4">Dashboard</h1>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>