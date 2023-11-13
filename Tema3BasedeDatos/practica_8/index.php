<?php




//realizo la conexion
try {
    $conexion=mysqli_connect("localhost","jose","josefa","bd_cv");
    mysqli_set_charset($conexion,"utf8");
} catch (Exception $e) {
   die("<p>No se ha podido conectarse a la base de datos: ".$e->getMessage()."</p></body></html>");
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,td,th{border:1px solid black}
        table{border-collapse:collapse;text-align:center}
        th{background-color:#CCC}
        table img{width:50px;}
        .enlace{border:none;background:none;cursor:pointer;color:blue;text-decoration:underline}
        .error{color:red}  
    </style>
</head>
<body>
<h1>Práctica 8</h1>
<?php
// so le damos al boton detalle
 if(isset($_POST["btnDetalle"])){
    require("vistas/vista_detalle.php");

 }
 if(isset($_POST["btnNuevoUsu"])){
    require("vistas/vista_nuevo.php");
    
 }


// muestro la consulta generaal de la tabla INICIO
require ("vistas/vista_tabla.php");


?>
</body>
</html>
