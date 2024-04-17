
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");


// Incluir la conexión a la base de datos
include 'API.php';

// Verificar si se proporcionó el parámetro de ID de categoría
if(isset($_GET['id_categoria'])) {
    // Obtener el ID de categoría de la solicitud
    $id_categoria = $_GET['id_categoria'];

    // Consulta SQL para obtener los productos de una categoría específica
    $query = "SELECT * FROM productos WHERE id_categoria = :id_categoria";

    try {
        // Preparar la consulta
        $statement = $pdo->prepare($query);

        // Bind el parámetro
        $statement->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);

        // Ejecutar la consulta
        $statement->execute();

        // Obtener los resultados
        $productos = $statement->fetchAll(PDO::FETCH_ASSOC);

        // Devolver los productos como JSON
        echo json_encode($productos);
    } catch (PDOException $e) {
        // Manejar errores
        echo "Error al obtener productos: " . $e->getMessage();
    }
} else {
    // Si no se proporcionó el ID de categoría, devolver un mensaje de error
    echo "Error: Se debe proporcionar un ID de categoría.";
}
?>
