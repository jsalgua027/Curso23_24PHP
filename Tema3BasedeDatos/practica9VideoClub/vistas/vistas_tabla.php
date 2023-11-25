<?php
//realizo la conexion 
//if(!$conexion){//si no hay conexion
    try {
        $conexion = mysqli_connect("localhost","jose","josefa","bd_videoclub");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("Práctica 9  <h1>Práctica 9</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() .  "</p></body></html>");
    }
//}
try {
        $consulta= " select * from peliculas";
        $resultado=mysqli_query($conexion,$consulta);
} catch (Exception $e) {
    die("<p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
}

echo"<h1>Video Club</h1>";
echo"<h2>Películas</h2>";
echo"<h3>Listado de Películas</h3>";

echo"<table>";
echo "<tr><th>id</th><th>Título</th><th>Carátula</th><th><form action='index.php' method='post'><button class='enlace' type='submit'name='btnNuevaPeli'>Películas+</button></form</th></tr>";
while ($tupla=mysqli_fetch_assoc($resultado)) {
    echo"<tr>";
    echo "<td>" . $tupla["idPelicula"] . "</td>";
    echo"<td><form action='index.php' method='post'><button class='enlace'type='submit' name='btnDetalle' value='". $tupla["idPelicula"]."'>".$tupla["titulo"]."</button></form></td>";
    echo "<td><img src='Img/" . $tupla["caratula"] . "' name='foto' title='caratula'></td>";
    echo "<td><form action='index.php' method='post'><input type='hidden' name='nombre_foto' value='".$tupla["caratula"]."'><button class='enalce' type='submit' value='" . $tupla["idPelicula"] . "' name='btnBorrar'>Borrar</button>" . " - " . "
    <button class='enalce' type='submit' value='" . $tupla["idPelicula"] . "' name='btnEditar'>Editar</button>";
    echo"</tr>";
}
echo"</table>";
?>
