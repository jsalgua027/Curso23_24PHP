<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");
header('Content-Type: application/json');
$host = 'localhost';
$dbname = 'restaurante';
$username = 'jose';
$password = 'josefa';

// Realizamos la conexión

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Establecer el modo de error PDO a excepción
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Recibir datos del pedido desde la aplicación React
    $data = json_decode(file_get_contents('php://input'), true);
    var_dump($data);
    // Insertar un nuevo registro en la tabla de pedidos
    $fecha = date("d-m-Y"); // Obtener la fecha actual
    $hora = date("H:i:s"); // Obtener la hora actual
   
    
    $stmt = $conn->prepare("INSERT INTO nacho_pedidos (fecha, hora) VALUES (:fecha, :hora )");
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':hora', $hora);
    $stmt->execute();

    // Obtener el ID del pedido recién insertado
    $id_pedido = $conn->lastInsertId();

    // Insertar los productos y cantidades asociados con el pedido en la tabla de pedido_producto
    foreach ($data['productos'] as $producto) {
        $id_producto = $producto['id_producto'];
        $cantidad = $producto['cantidad'];

        $stmt = $conn->prepare("INSERT INTO nacho_pedido_producto (id_pedido, id_producto, cantidad) VALUES (:id_pedido, :id_producto, :cantidad)");
        $stmt->bindParam(':id_pedido', $id_pedido);
        $stmt->bindParam(':id_producto', $id_producto);
        $stmt->bindParam(':cantidad', $cantidad);
        $stmt->execute();
    }

    // Enviar respuesta de éxito a la aplicación React
    $response = array("status" => "success", "message" => "Pedido creado correctamente");
    echo json_encode($response);
} catch(PDOException $e) {
    // En caso de error, enviar respuesta de error a la aplicación React
    $response = array("status" => "error", "message" => "Error al crear el pedido: " . $e->getMessage());
    echo json_encode($response);
}

// Cerrar la conexión con la base de datos
$conn = null;
?>
