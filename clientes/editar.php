<?php
require_once '../Config/database.php';
require_once 'funciones.php';

$clienteController = new ClienteController();

if (isset($_GET['id'])){
    $cliente = $clienteController->obtenerCliente($_GET['id']);
}

// Si se envia los datos por el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    try {
        $clienteController->actualizarCliente($_GET['id'], $_POST);
        // $clienteController->actualizarCliente($cliente->_id);
        header('Location: index.php');
        exit;
    } catch (Exception $e){
        throw new Exception('Cliente no actualizado' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Editar Cliente</title>
</head>
<body>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php">Clientes</a></li>
                <li class="breadcrumb-item active">Editar Cliente</li>
            </ol>
        </nav>

        <h1>Editar Cliente</h1>

        <form method="POST" class="needs-validation">
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?PHP echo $cliente->nombre; ?>" required>
                <div class="invalid-feedback">
                    Por favor ingrese el nombre del cliente
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo:</label>
                <input type="email" id="correo" name="correo" class="form-control" value="<?PHP echo $cliente->correo; ?>" required>
                <div class="invalid-feedback">
                    Por favor ingrese correo electrónico válido
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" class="form-control" value="<?PHP echo $cliente->telefono; ?>" required>
                <div class="invalid-feedback">
                    Por favor ingrese un número de teléfono
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección:</label>
                <textarea type="text" id="direccion" name="direccion" class="form-control" required><?PHP echo $cliente->direccion; ?></textarea>
                <div class="invalid-feedback">
                    Por favor ingrese la dirección
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>