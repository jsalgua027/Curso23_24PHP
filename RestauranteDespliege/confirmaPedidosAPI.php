<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");
header('Content-Type: application/json');

$host = 'lldn295.servidoresdns.net';
$dbname = 'qahz656';
$username = 'qaiw208';
$password = '1PesetaSpain';

// Realizamos la conexión

try {
    $pdo= new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    // Recibir datos del pedido desde la aplicación React
    $data = json_decode(file_get_contents('php://input'), true);
  
    if (!isset($data['datosPedido'])){
        exit;
    }

    // Insertar un nuevo registro en la tabla de pedidos
    $fecha = date("Y-m-d"); // Obtener la fecha actual
    $hora = date("H:i:s"); // Obtener la hora actual
    
    $stmt = $pdo->prepare("INSERT INTO nacho_pedidos (fecha, hora) VALUES (:fecha, :hora )");
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':hora', $hora);
    $stmt->execute();

    // Obtener el ID del pedido recién insertado
    $id_pedido = $pdo->lastInsertId();

    // Insertar 
    foreach ($data['datosPedido'] as $producto) {
        $id_producto = $producto['id_producto']; 
        $cantidad = $producto['cantidad']; 

        $stmt = $pdo->prepare("INSERT INTO nacho_pedido_producto (id_pedido, id_producto, cantidad) VALUES (:id_pedido, :id_producto, :cantidad)");
        $stmt->bindParam(':id_pedido', $id_pedido);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->execute();
    }

    // Enviar respuesta de éxito a la aplicación React
    $response = array("status" => "success", "message" => "Pedido creado correctamente".$id_pedido);
    echo json_encode($response);
} catch(PDOException $e) {
    // En caso de error, enviar respuesta de error a la aplicación React
    $response = array("status" => "error", "message" => "Error al crear el pedido: " . $e->getMessage());
    echo json_encode($response);
}
?>
