<?php
require_once __DIR__ . '/../config/database.php';

class ProductoController {
    private $db;
    private $collection;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getDatabase();
        $this->collection = $this->db->productos;
    }

    public function contarProductos() {
        try {
            return $this->collection->countDocuments([
                'disponible' => true
            ]);
        } catch (Exception $e) {
            return 0;
        }
    }

    public function listarProductos() {
        try {
            return $this->collection->find([], [
                'sort' => ['categoria' => 1, 'nombre' => 1]
            ]);
        } catch (Exception $e) {
            throw new Exception("Error al listar los productos: " . $e->getMessage());
        }
    }

    public function obtenerProducto($id) {
        try {
            return $this->collection->findOne([
                '_id' => new MongoDB\BSON\ObjectId($id)
            ]);
        } catch (Exception $e) {
            throw new Exception("Error al obtener el producto: " . $e->getMessage());
        }
    }

    public function crearProducto($datos) {

        try {
            $resultado = $this->collection->insertOne([
                'nombre' => trim($datos['nombre']),
                'precio' => floatval($datos['precio']),
                'descripcion' => trim($datos['descripcion']),
                'categoria' => trim($datos['categoria']),
                'disponible' => isset($datos['disponible']),
                'fecha_creacion' => new MongoDB\BSON\UTCDateTime(),
                'fecha_actualizacion' => new MongoDB\BSON\UTCDateTime()
            ]);

            return $resultado->getInsertedId();
        } catch (Exception $e) {
            throw new Exception("Error al crear el producto: " . $e->getMessage());
        }
    }

    public function actualizarProducto($id, $datos) {

        try {
            $resultado = $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)],
                ['$set' => [
                    'nombre' => trim($datos['nombre']),
                    'precio' => floatval($datos['precio']),
                    'descripcion' => trim($datos['descripcion']),
                    'categoria' => trim($datos['categoria']),
                    'disponible' => isset($datos['disponible']),
                    'fecha_actualizacion' => new MongoDB\BSON\UTCDateTime()
                ]]
            );

            if ($resultado->getModifiedCount() === 0 && $resultado->getMatchedCount() === 0) {
                throw new Exception("No se encontró el producto a actualizar");
            }

            return true;
        } catch (Exception $e) {
            throw new Exception("Error al actualizar el producto: " . $e->getMessage());
        }
    }

    public function eliminarProducto($id) {
        try {
            // Verificar si el producto existe antes de eliminar
            $producto = $this->obtenerProducto($id);
            if (!$producto) {
                throw new Exception("Producto no encontrado");
            }

            $resultado = $this->collection->deleteOne([
                '_id' => new MongoDB\BSON\ObjectId($id)
            ]);

            if ($resultado->getDeletedCount() === 0) {
                throw new Exception("No se pudo eliminar el producto");
            }

            return true;
        } catch (Exception $e) {
            throw new Exception("Error al eliminar el producto: " . $e->getMessage());
        }
    }
}