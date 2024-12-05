<?php
require_once '../config/database.php';
require_once 'funciones.php';

// Verificar si se ha recibido el ID del cliente a eliminar
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $clienteController = new ClienteController();

    try {
        // Obtener los datos del cliente para confirmar la eliminación
        $cliente = $clienteController->obtenerClientePorId($id);

        if (!$cliente) {
            throw new Exception("Cliente no encontrado.");
        }

        // Si el formulario de confirmación ha sido enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $clienteController->eliminarCliente($id);
            header('Location: index.php?mensaje=Cliente eliminado con éxito');
            exit;
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
} else {
    header('Location: index.php?error=ID no especificado');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Eliminar Cliente</title>
</head>
<body>
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
            <li class="breadcrumb-item"><a href="index.php">Clientes</a></li>
            <li class="breadcrumb-item active" aria-current="page">Eliminar Cliente</li>
        </ol>
    </nav>
    <h1>Eliminar Cliente</h1>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <strong>Error:</strong> <?= htmlspecialchars($error) ?>
        </div>
    <?php else: ?>
        <p>¿Estás seguro de que deseas eliminar al cliente <strong><?= htmlspecialchars($cliente['nombre']) ?></strong>?</p>

        <form method="POST">
            <button type="submit" class="btn btn-danger">Eliminar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    <?php endif; ?>
</div>
</body>
</html>
