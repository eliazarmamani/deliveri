<?PHP

use MongoDB\Collection;
use MongoDB\Operation\Explain;

    require_once __DIR__ . '/../config/database.php';

    class PedidoController {
        private $db;
        private $collection;

        public function __construct(){
            $database = new Database();
            $this->db = $database->getDatabase();
            $this->collection = $this->db->pedidos;
        }

        public function listarPedidos(){
            try{
                $pipeline = [
                    [
                        '$lookup' => [
                            'from' => 'clientes',
                            'localField' => 'id_cliente',
                            'foreignField' => '_id',
                            'as' => 'cliente_info'
                        ]
                    ],
                    [
                        '$unwind' => [
                            'path' => '$cliente_info',
                            'preserveNullAndEmptyArrays' => true
                        ]
                    ],
                    [
                        '$project' => [
                            '_id' => 1,
                            'total' => 1,
                            'estado' => 1,
                            'fecha' => 1,
                            'hora' => 1,
                            'estado_pago' => 1,
                            'cliente' => [
                                'nombre' => '$cliente_info.nombre',
                                'telefono' => '$cliente_info.telefono',
                                'correo' => '$cliente_info.correo'
                            ]
                        ]
                    ],
                    [
                        '$sort' => [
                            'fecha' => -1,
                            'hora' => -1
                        ]
                    ]
                        
                ];
                return iterator_to_array($this->collection->aggregate($pipeline));
            } catch (Exception $e){
                error_log("Error en ListarPedidos". $e->getMessage());
                return [];
            }
        }

        public function crearPedido($datos){
            try{
                $productos = $this->procesarProductos($datos['productos']);
                $total = $this->calcularTotal($productos);
                

                $documento = [
                    'id_cliente' => new MongoDB\BSON\ObjectId($datos['id_cliente']),
                    'productos' => $productos,
                    'total' => $total,
                    'estado' => 'pendiente',
                    'fecha' => date('Y-m-d'),
                    'hora' => date('H:i:s'),
                    'direccion_entrega' => trim($datos['direccion_entrega']),
                    'metodo_pago' => $datos['metodo_pago'],
                    'estado_pago' => $datos['estado_pago'],
                    'fecha_creacion' => new MongoDB\BSON\UTCDateTime(),
                    'fecha_actualizacion' => new MongoDB\BSON\UTCDateTime()
                ];

                $resultado = $this->collection->insertOne($documento);
                return $resultado->getInsertedId();

            } catch (Exception $e){
                throw new Exception("Error al crear el pedido: " . $e->getMessage());
            }
        }

        private function calcularTotal($productos){
            $total = 0;
            foreach ($productos as $producto){
                $total = $total + $producto['precio_unitario'] * $producto['cantidad'];
            }
            return round($total,2);
        }

        private function procesarProductos($productos) {
            $productosFormateados = [];
            foreach ($productos as $producto) {
                if (!empty($producto['id_producto'])) {
                    // Obtener información del producto para validar el precio
                    $productoInfo = $this->db->productos->findOne([
                        '_id' => new MongoDB\BSON\ObjectId($producto['id_producto'])
                    ]);
    
                    if (!$productoInfo) {
                        throw new Exception("Producto no encontrado");
                    }
    
                    $productosFormateados[] = [
                        'id_producto' => new MongoDB\BSON\ObjectId($producto['id_producto']),
                        'cantidad' => intval($producto['cantidad']),
                        'precio_unitario' => floatval($productoInfo->precio),
                        'notas' => isset($producto['notas']) ? trim($producto['notas']) : ''
                    ];
                }
            }
            return $productosFormateados;
        }
    }

    
?>