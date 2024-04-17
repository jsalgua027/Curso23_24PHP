
<?php
// Endpoint para obtener todas las categorías
include 'API.php';

$query = "SELECT * FROM categorias";

try {
    $statement = $pdo->query($query);
    $categorias = $statement->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($categorias);
} catch (PDOException $e) {
    echo "Error al obtener categorías: " . $e->getMessage();
}
?>