<?php
require_once '../Config/database.php';
require_once 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productoController = new ProductoController();
    try {
        $productoController->crearProducto($_POST);
        header('Location: index.php');
        exit;
    } catch (Exception $e) {

    }
}

$categorias = [
    'Hamburguesas',
    'Pizzas',
    'Bebidas',
    'Postres',
    'Ensaladas',
    'Complementos'
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php">Productos</a></li>
                <li class="breadcrumb-item active">Nuevo Producto</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Nuevo Producto</h1>
            </div>
            <div class="card-body">

                <form method="POST" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-8 mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre del producto
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <label for="precio" class="form-label">Precio:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="precio" name="precio" 
                                       step="0.01" min="0" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese un precio válido
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8 mb-3">
                            <label for="categoria" class="form-label">Categoría:</label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="">Seleccione una categoría</option>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?php echo htmlspecialchars($categoria); ?>">
                                        <?php echo htmlspecialchars($categoria); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione una categoría
                            </div>
                        </div>

                        <div class="col-4 mb-3">
                            <label class="form-label">Disponibilidad:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="disponible" 
                                       name="disponible" value="1" checked>
                                <label class="form-check-label" for="disponible">
                                    Producto disponible
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" 
                                  rows="3" required></textarea>
                        <div class="invalid-feedback">
                            Por favor ingrese una descripción
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php" class="btn btn-secondary me-md-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Guardar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>