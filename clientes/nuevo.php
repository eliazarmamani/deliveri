<?php

use MongoDB\Operation\Explain;

    require_once '../config/database.php';
    require_once 'funciones.php';

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $clienteController= New ClienteController();
        try{
            $clienteController->crearCliente($_POST);
            header('Location: index.php');
            exit;
        } catch(Exception $e) {
            throw new Exception("Error al obtener el cliente: " . $e->getMessage());
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Nuevo Cliente</title>
</head>
<body>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item"><a href="index.php">Clientes</a></li>
                <li class="breadcrumb-item">Nuevo Cliente</li>
            </ol>
        </nav>
        <h1>Nuevo Cliente</h1>
        <form method="POST" class="needs-validation">
            <div class="mb-3">
                <label class="form-label">Nombre:</label>
                <input type="text" id="nombre" name="nombre" class="form-control" required>
                <div class="invalid-feedback">
                    Por favor ingrese el nombre del cliente
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo:</label>
                <input type="email" id="correo" name="correo" class="form-control" required>
                <div class="invalid-feedback">
                    Por favor ingrese correo electrónico válido
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" class="form-control" required>
                <div class="invalid-feedback">
                    Por favor ingrese un número de teléfono
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección:</label>
                <textarea type="text" id="direccion" name="direccion" class="form-control" required></textarea>
                <div class="invalid-feedback">
                    Por favor ingrese la dirección
                </div>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="index.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</body>
</html>