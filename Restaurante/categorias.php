
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");


// Endpoint para obtener todas las categorías
include 'API.php';

$query = "SELECT * FROM nacho_categorias";

try {
    $statement = $pdo->query($query);
    $categorias = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($categorias);
} catch (PDOException $e) {
    echo "Error al obtener categorías: " . $e->getMessage();
}
?>