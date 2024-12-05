<?php
    require_once '../Config/database.php';
    require_once 'funciones.php';

    $pedidosController = new PedidoController();
    // Obtener Pedidos
    $pedidos = $pedidosController->listarPedidos();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Gestión de Pedidos</title>
</head>
<body>
    <div class="container mt-4">
        <!-- Navegación -->
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../index.php">Inicio</a></li>
                <li class="breadcrumb-item">Pedidos</li>
            </ol>
        </nav>

        <!-- Encabezado y botón Nuevo -->
         <div class="row">
            <div class="col">
                <h1>Gestión de Pedidos</h1>
            </div>
            <!-- Botón Nuevo -->
            <div class="col text-end">
                 <a class="btn btn-primary" href="nuevo.php">
                    <i class="bi bi-plus-circle"></i> Nuevo
                </a>
            </div>
         </div>

        <!-- Tabla de Pedidos -->
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id Pedido</th>
                        <th>Cliente</th>
                        <th>Fecha y Hora</th>
                        <th>Total</th>
                        <th>Estado</th>
                        <th>Pago</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach($pedidos as $pedido): ?>
                        <tr>
                            <td>
                                <?= $pedido->_id ?>
                            </td>
                            <td>
                                <?= $pedido->cliente['nombre'] ?>
                            </td>
                            <td>
                                <?= $pedido->fecha ?>
                            </td>
                            <td>
                                <?= $pedido->total ?>
                            </td>
                            <td>
                                <?= $pedido->estado ?>
                            </td>
                            <td>
                                <?= $pedido->estado_pago ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>