<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");

$host = 'localhost';
$dbname = 'restaurante';
$username = 'jose';
$password = 'josefa';

// Realizamos la conexión

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $datos_pedido = json_decode(file_get_contents("php://input"), true);

        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $total_precio = 0;

        $stmt_pedido = $pdo->prepare("INSERT INTO nacho_pedidos (fecha, hora) VALUES (:fecha, :hora)");
        $stmt_producto = $pdo->prepare("INSERT INTO nacho_pedido_producto (id_pedido, id_producto, cantidad) VALUES (:id_pedido, :id_producto, :cantidad)");

        $pdo->beginTransaction();

        $stmt_pedido->bindParam(':fecha', $fecha);
        $stmt_pedido->bindParam(':hora', $hora);
        $stmt_pedido->execute();

        $id_pedido = $pdo->lastInsertId();

        foreach ($datos_pedido['productos'] as $producto) {
            $total_precio += $producto['precio'] * $producto['cantidad'];

            $stmt_producto->bindParam(':id_pedido', $id_pedido);
            $stmt_producto->bindParam(':id_producto', $producto['id_producto']);
            $stmt_producto->bindParam(':cantidad', $producto['cantidad']);
            $stmt_producto->execute();
        }

        $pdo->commit();

        $respuesta = array('id_pedido' => $id_pedido, 'total_precio' => $total_precio);
        echo json_encode($respuesta);
    }
} catch (PDOException $e) {
    $error = array('error' => $e->getMessage());
    echo json_encode($error);
}
?>
