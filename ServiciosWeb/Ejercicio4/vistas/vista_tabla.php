<?php
$url=DIR_SERV."/usuarios";
$repuesta=consumir_servicios_REST($url,"GET");
$obj=json_decode($repuesta);
if(!$obj){
    session_destroy();
    die("<p>Error consumiendo el servicio: ".$url."</p></body></html>");
}
if(isset($obj->error))
{
    session_destroy();
    die("<p>".$obj->error."</p></body></html>");
}



echo "<table>";
echo "<tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th></tr>";
foreach($obj->usuarios as $tupla) {
    echo "<tr>";
    echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='" . $tupla->id_usuario . "' name='btnDetalle' title='Detalles del Usuario'>" . $tupla->nombre . "</button></form></td>";
    echo "<td><form action='index.php' method='post'><input type='hidden' name='nombre_usuario' value='" . $tupla->nombre . "'><button class='enlace' type='submit' value='" . $tupla->id_usuario . "' name='btnBorrar'><img src='images/borrar.png' alt='Imagen de Borrar' title='Borrar Usuario'></button></form></td>";
    echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='" . $tupla->id_usuario. "' name='btnEditar'><img src='images/editar.png' alt='Imagen de Editar' title='Editar Usuario'></button></form></td>";
    echo "</tr>";
}
echo "</table>";


if (isset($_SESSION["mensaje"])) {
    echo "<p class='mensaje'>" . $_SESSION["mensaje"] . "</p>";
    session_destroy();
    // como destruir una variable
    //unset($_SESSION["mensaje"]);
}
