<?php
echo "<h3>Detalles del usuario con id: " . $_POST["btnDetalle"] . "</h3>";
try {
    $consulta = "select * from usuarios where id_usuario='" . $_POST["btnDetalle"] . "'";
    $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
}
// se he realizado la conexion con exito y la consulta

if (mysqli_num_rows($resultado)>0) { // si el numero de filas del resultado es mayor de cero OSEA que hay datos en mi consulta
    $datos_usuario = mysqli_fetch_assoc($resultado);
    mysqli_free_result($resultado);

    echo "<p>";
    echo "<strong>Id: </strong>" . $datos_usuario["id_usuario"] . "<br>";
    echo "<strong>Usuario: </strong>" . $datos_usuario["usuario"] . "<br>";
    echo "<strong>Clave: </strong>" . $datos_usuario["clave"]."<br>";
    echo "<strong>Nombre: </strong>" . $datos_usuario["nombre"] . "<br>";
    echo "<strong>DNI: </strong>" . $datos_usuario["dni"] . "<br>";
    echo "<strong>Sexo: </strong>" . $datos_usuario["sexo"] . "<br>";
    echo"<img src='Img/". $datos_usuario["foto"]."' name='foto' title='foto perfil' width='250' height='200'>";
    echo "</p>";
}
else{
    echo "<p>El usuario seleccionado ya no se encuentra registrado en la BD</p>";

}
/* 
        TEORIA

$con= mysqli_connect("localHost","my_user","my_password","mydb");
if(mysqli_connect_errno()){
    echo "Failed to connect to MysQL: ", mysqli_connect_error();
    exit();

}
mysqli_query($con, "INSERT INTO Person (FirstName, LastName, Age) VALUES ('Glen','Quagmire', 33)");

// print auto-generate id

echo "New record has id: ", mysqli_insert_id($con); // esto coge la última id usadfa

mysqli_close($con);

// para borrar la foto 
unlink("Img/....jpg");
mysqli_insert_id($con);
 */ 

