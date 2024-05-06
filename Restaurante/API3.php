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

    // Verificamos si la solicitud es un POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Decodificamos los datos JSON recibidos
        $datos_pedido = json_decode(file_get_contents("php://input"), true);

        // Obtenemos la fecha y la hora actual
        $fecha = date('d/m/Y');
        $hora = date('H:i:s');

        // Inicializamos el total del precio del pedido
        $total_precio = 0;

        // Preparamos la consulta SQL para insertar el pedido y sus productos
        $stmt_pedido = $pdo->prepare("INSERT INTO nacho_pedidos () VALUES ()");
        $stmt_producto = $pdo->prepare("INSERT INTO nacho_pedido_producto (id_pedido, id_producto, fecha, hora, cantidad) VALUES (?, ?, ?, ?, ?)");

        // Iniciamos una transacción
        $pdo->beginTransaction();

        // Ejecutamos la consulta para insertar el pedido
        $stmt_pedido->execute();

        // Obtenemos el ID del pedido insertado
        $id_pedido = $pdo->lastInsertId();

        // Recorremos los productos del pedido
        foreach ($datos_pedido['productos'] as $producto) {
            // Calculamos el total del precio del producto (precio * cantidad)
            $total_precio += $producto['precio'] * $producto['cantidad'];

            // Ejecutamos la consulta para insertar el producto en el pedido
            $stmt_producto->execute([$id_pedido, $producto['id_producto'], $fecha, $hora, $producto['cantidad']]);
        }

        // Confirmamos la transacción
        $pdo->commit();

        // Devolvemos una respuesta con el ID del pedido y el total del precio
        $respuesta = array('id_pedido' => $id_pedido, 'total_precio' => $total_precio);
        echo json_encode($respuesta);
    }
} catch (PDOException $e) {
    // Si hay un error en la conexión o en la consulta, devolvemos un JSON con el error
    $error = array('error' => $e->getMessage());
    echo json_encode($error);
}
?>
