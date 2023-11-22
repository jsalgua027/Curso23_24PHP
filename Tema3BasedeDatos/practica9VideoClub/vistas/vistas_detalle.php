<?php
//realizo la conexion 

try {
    $conexion = mysqli_connect("localHost", "jose", "josefa", "bd_videoclub");
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    mysqli_close($conexion);
    die(error_page("Práctica 9", "<h1>Práctica 9</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
}
