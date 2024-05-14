<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");
header('Content-Type: application/json');

$host = 'lldn295.servidoresdns.net';
$dbname = 'qahz656';
$username = 'qaiw208';
$password = '1PesetaSpain';

try {
    $conn= new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));

    // Consulta para obtener todos los pedidos con los detalles de los productos
    $sql = "SELECT p.*, pp.id_producto, pp.cantidad, pr.producto, pr.precio, pr.portadaFoto, pr.id_categoria 
            FROM nacho_pedidos p
            INNER JOIN nacho_pedido_producto pp ON p.id_pedido = pp.id_pedido
            INNER JOIN nacho_productos pr ON pp.id_producto = pr.id_producto";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);
    // Ejecutar la consulta
    $stmt->execute();
    // Obtener todos los resultados como un array asociativo
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Array para almacenar los datos de los pedidos
    $pedidos = array();

    // Procesar los resultados
    foreach ($results as $row) {
        // Crear un nuevo objeto de pedido si es un pedido nuevo
        if (!isset($pedidos[$row['id_pedido']])) {
            $pedidos[$row['id_pedido']] = array(
                'id_pedido' => $row['id_pedido'],
                'fecha' => $row['fecha'],
                'hora' => $row['hora'],
                'entregado' => $row['entregado'],
                'productos' => array()
            );
        }

        // Agregar el producto al pedido actual
        $pedidos[$row['id_pedido']]['productos'][] = array(
            'id_producto' => $row['id_producto'],
            'cantidad' => $row['cantidad'],
            'producto' => $row['producto'],
            'precio' => $row['precio'],
            'portadaFoto' => $row['portadaFoto'],
            'id_categoria' => $row['id_categoria']
        );
    }

    // Devolver los pedidos en formato JSON
    echo json_encode(array_values($pedidos));
} catch (PDOException $e) {
    // En caso de error, imprimir el mensaje de error
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión a la base de datos
$conn = null;
