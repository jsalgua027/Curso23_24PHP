<?php
// Configuración de la conexión a la base de datos
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");
header('Content-Type: application/json');

$host = 'lldn295.servidoresdns.net';
$dbname = 'qahz656';
$username = 'qaiw208';
$password = '1PesetaSpain';

try {
    // Obtener el contenido del cuerpo de la solicitud POST como un JSON
    $postDataJSON = file_get_contents('php://input');

    // Decodificar el JSON en un array asociativo
    $postData = json_decode($postDataJSON, true);

    // Obtener el número de pedido de los datos decodificados
    $id_pedido = $postData['id_pedido'];

    $conn= new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));

    // Preparar la consulta SQL para actualizar el estado de entrega del pedido
    $sql = "UPDATE nacho_pedidos SET entregado = 2 WHERE id_pedido = :id_pedido";

    // Preparar la consulta
    $stmt = $conn->prepare($sql);

    // Bind de parámetros
    $stmt->bindParam(':id_pedido', $id_pedido);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar el número de filas afectadas
    $rowCount = $stmt->rowCount();
    if ($rowCount > 0) {
        echo json_encode(["message" => "El estado de entrega del pedido $id_pedido ha sido actualizado correctamente."]);
    } else {
        // En caso de error
        echo json_encode(["error" => "No se encontró ningún pedido con el número $id_pedido."]);
    }
} catch (PDOException $e) {
    echo "Error al actualizar el estado de entrega del pedido: " . $e->getMessage();
}

// Cerrar la conexión
$conn = null;
