<?php

//Mostrar los detalles de la película

echo "<h3>Detalles de la película con id: " . $_POST["btnDetalle"] . "</h3>";

// Hacemos una conexión al servidor
try {
    $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die("<p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
}

// Consulta select para recoger los datos de la película
try {
    $consulta = "select * from peliculas where idPelicula='" . $_POST["btnDetalle"] . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
}

// Mostrar los datos
if (mysqli_num_rows($resultado) > 0) {
    $datos_peli = mysqli_fetch_assoc($resultado);
    mysqli_free_result($resultado);

    echo "<p>";
    echo "<strong>Título: </strong>" . $datos_peli["titulo"] . "<br>";
    echo "<strong>Director: </strong>" . $datos_peli["director"] . "<br>";
    echo "<strong>Temática: </strong>" . $datos_peli["tematica"] . "<br>";
    echo "<strong>Sinopsis: </strong>" . $datos_peli["sinopsis"] . "<br>";
    echo "<strong>Carátula: </strong><img src='Img/" . $datos_peli["caratula"] . "' alt='Imagen de caratula' title='Imagen de caratula'><br>";
    echo "</p>";
} else
    echo "<p>La película seleccionada ya no se encuentra registrada en la BD</p>";


echo "<form action='index.php' method='post'>";
echo "<p><button type='submit'>Volver</button></p>";
echo "</form>";
