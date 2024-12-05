<?php
require_once __DIR__ . '/../config/database.php';

class ClienteController{
    private $db;
    private $collection;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getDatabase();
        $this->collection = $this->db->clientes;
    }

    public function listarClientes(){
        try {
            return $this->collection->find([], [
                'sort' => ['nombre' => 1]
            ]);
        } catch (Exception $e) {
            throw new Exception("Error al listar los clientes: " . $e->getMessage());
        }
    }

    public function crearCliente($datos){
        try{
            $resultado = $this->collection->insertOne(
                [
                    'nombre' => $datos['nombre'],
                    'correo' => $datos['correo'],
                    'telefono' => $datos['telefono'],
                    'direccion' => $datos['direccion']
                ]
                );
        }catch(Exception $e){
            throw new Exception("Error al crear el cliente: " . $e->getMessage());
        }
    }

    public function obtenerCliente($id){
        try{
            return $this->collection->findOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)]
            );
        } catch(Exception $e) {
            throw new Exception("Error al obtener el cliente: " . $e->getMessage());
        }
    }

    public function actualizarCliente($id, $datos){
        try{
            $resultado = $this->collection->updateOne(
                ['_id' => new MongoDB\BSON\ObjectId($id)],
                ['$set' => 
                    [
                        'nombre' => $datos['nombre'],
                        'correo' => $datos['correo'],
                        'telefono' => $datos['telefono'],
                        'direccion' => $datos['direccion']
                    ]
                ]
                    );
        } catch (Exception $e){
            throw new Exception("No se realizaron cambios en el cliente" . $e->getMessage());
        }

    }

    public function eliminarCliente($id){
        try{
            // Verificar si el cliente existe antes de eliminar
            $cliente = $this->obtenerCliente($id);
            if (!$cliente){
                throw new Exception("Cliente no encontrado");
            }

            //Manda la orden de eliminar en la colleción
            $resultado = $this->collection->deleteOne(
                ['_id' => new MongoDB\BSON\ObjectID($id)]
            );

            // Muestra un error en pantalla si NO eliminó
            if ($resultado->getDeletedCount() === 0){
                throw new Exception("No se pudo eliminar el cliente");
            }

        } catch (Exception $e) {
            throw new Exception("Error al eliminar el cliente: " . $e->getMessage());
        }

    }
}
//Procesar acciones si se reciben por GET

if (isset($_GET['action']) && isset($_GET['id'])) {
    $controller = new ClienteController();

    if($_GET['action'] = 'eliminar'){
        $controller->eliminarCliente($_GET['id']);
        header('Location: index.php');
    }
}

?>