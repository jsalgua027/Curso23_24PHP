<?php
//realizo la conexion 
//if(!$conexion){//si no hay conexion
try {
    $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_videoclub");
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    mysqli_close($conexion);
    die("Práctica 9  <h1>Práctica 9</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() .  "</p></body></html>");
}
//}
try {
    $consulta = " select * from peliculas where idPelicula=' " . $_POST["btnDetalle"] . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    die("<p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
}

echo "<h1>Información Pelicula</h1>";
if (mysqli_num_rows($resultado) > 0) {
    $datos_pelicula = mysqli_fetch_assoc($resultado);
    mysqli_free_result($resultado);
    echo"<div>";
    echo "<p>";
    echo "<strong>Título de la pelicula</strong><br>";
    echo "<input type='text' name='titulo' id='titulo' value='" . $datos_pelicula["titulo"] . "'></input><br><br>";
    echo "<strong>Director de la pelicula</strong><br>";
    echo "<input type='text' name='titulo' id='titulo' value='" . $datos_pelicula["director"] . "'></input><br><br>";
    echo "<strong>Temática de la pelicula</strong><br>";
    echo "<input type='text' name='titulo' id='titulo' value='" . $datos_pelicula["tematica"] . "'></input><br><br>";
    echo "<strong>Sipnosis de la película</strong><br>";
    echo "<textarea rows='10' cols='50'>".$datos_pelicula["sinopsis"]."</textarea><br><br>";
    echo '<button name="btnAtras" id=btnAtras>Atras</button>';
    echo "</p>";
    echo "<p id='foto'>";
    echo "<strong>Carátura Actual</strong><br>";
    echo "<img src='Img/" . $datos_pelicula["caratula"] . "' name='foto' title='caratula' id='foto-caratula'>";
    echo "</p>";
    echo"</div>";
} else {
    echo "<p>La Película  seleccionada ya no se encuentra registrado en la BD</p>";
}
