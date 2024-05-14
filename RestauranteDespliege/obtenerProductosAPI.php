<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, PATCH");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, token, Content-Type, cache-control");
header('Content-Type: application/json');

$host = 'lldn295.servidoresdns.net';
$dbname = 'qahz656';
$username = 'qaiw208';
$password = '1PesetaSpain';

// realizo la conexion
try {
    $pdo= new PDO("mysql:host=".$host.";dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));


    // Consulta SQL para obtener productos agrupados por categoría
    $sql = "SELECT c.id_categoria, c.categoria, p.id_producto, p.producto, p.precio, p.portadaFoto 
            FROM nacho_categorias c
            LEFT JOIN nacho_productos p ON c.id_categoria = p.id_categoria
            ORDER BY c.id_categoria, p.id_producto";
    
    $stmt = $pdo->query($sql);
    $productosPorCategoria = array();

    // Iterar sobre los resultados y agrupar los productos por categoría
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $categoriaId = $row['id_categoria'];
        $categoriaNombre = $row['categoria'];

        // Si es la primera vez que encontramos esta categoría, creamos un nuevo array para sus productos
        if (!isset($productosPorCategoria[$categoriaId])) {
            $productosPorCategoria[$categoriaId] = array(
                'id_categoria' => $categoriaId, 
                'categoria' => $categoriaNombre,
                'productos' => array()
            );
        }

        // Agregamos el producto al array de productos de la categoría
        $productosPorCategoria[$categoriaId]['productos'][] = array(
            'id_producto' => $row['id_producto'],
            'producto' => $row['producto'],
            'precio' => $row['precio'],
            'portadaFoto' => $row['portadaFoto']
        );
    }

    // Convertimos el array a formato JSON
    $json = json_encode($productosPorCategoria);

    // Devolvemos el JSON como respuesta
    header('Content-Type: application/json');
    echo $json;
} catch (PDOException $e) {
    // Si hay un error en la conexión o en la consulta, devolvemos un JSON con el error
    $error = array('error' => $e->getMessage());
    echo json_encode($error);
}
?>