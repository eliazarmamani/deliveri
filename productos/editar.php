<?php
require_once '../Config/database.php';
require_once 'funciones.php';

$productoController = new ProductoController();

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit;
}

try {
    $producto = $productoController->obtenerProducto($_GET['id']);
    if (!$producto) {
        throw new Exception('Producto no encontrado');
    }
} catch (Exception $e) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $productoController->actualizarProducto($_GET['id'], $_POST);
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
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php">Productos</a></li>
                <li class="breadcrumb-item active">Editar Producto</li>
            </ol>
        </nav>

        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Editar Producto</h1>
            </div>
            <div class="card-body">

                <form method="POST" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" 
                                   value="<?php echo htmlspecialchars($producto->nombre); ?>" required>
                            <div class="invalid-feedback">
                                Por favor ingrese el nombre del producto
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="precio" class="form-label">Precio:</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="precio" name="precio" 
                                       step="0.01" min="0" value="<?php echo $producto->precio; ?>" required>
                                <div class="invalid-feedback">
                                    Por favor ingrese un precio válido
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="categoria" class="form-label">Categoría:</label>
                            <select class="form-select" id="categoria" name="categoria" required>
                                <option value="">Seleccione una categoría</option>






                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?php echo htmlspecialchars($categoria); ?>"
                                            <?php echo $producto->categoria === $categoria ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($categoria); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                Por favor seleccione una categoría
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Disponibilidad:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="disponible" 
                                       name="disponible" value="1" <?php echo $producto->disponible ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="disponible">
                                    Producto disponible
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" 
                                rows="3" required><?php echo htmlspecialchars($producto->descripcion); ?></textarea>
                        <div class="invalid-feedback">
                            Por favor ingrese una descripción
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="index.php" class="btn btn-secondary me-md-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>