<?php
    require_once '../config/database.php';
    require_once 'funciones.php';

    $clienteController = new ClienteController();
    $clientes = $clienteController->listarClientes();
?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Clientes</title>
</head>
<body>
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item active">Clientes</li>
            </ol>
        </nav>

        <div class="row mb-3">
            <div class="col">
                <h1>Gestión Clientes</h1>
            </div>
            <div class="col text-end">
                <a href="nuevo.php" class="btn btn-primary">Nuevo Cliente</a>
            </div>
        </div>

        <table class="table table-striped table-bordered -table-hover table-condensed">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>telefono</th>
                    <th>direccion</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?PHP  foreach ($clientes as $cliente):   ?>
                <tr>
                <td><?PHP echo $cliente->_id."<br>"; ?></td>
                    <td><?PHP echo $cliente->nombre."<br>"; ?></td>
                    <td><?PHP echo $cliente->correo."<br>"; ?></td>
                    <td><?PHP echo $cliente->telefono."<br>"; ?></td>
                    <td><?PHP echo $cliente->direccion."<br>"; ?></td>
                    <td>
                        <a href="editar.php?id=<?PHP echo $cliente->_id; ?>" class="btn btn-warning">Editar</a>
                        <a href="funciones.php?action=eliminar&id=<?PHP echo $cliente->_id ?>" 
                            class="btn btn-danger"
                            onclick="return confirm('¿Está seguro de eliminar este cliente?')">
                        Eliminar
                        </a>
                    </td>
                </tr>
            <?PHP endforeach;  ?>
            </tbody>
        </table>

    </div>
</body>
</html>