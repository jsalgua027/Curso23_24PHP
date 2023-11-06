<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1º CRUD</title>
    <style>
        table,td,th{border:1px solid black}
        table{border-collapse:collapse;text-align:center}
        th{background-color:#CCC}
        table img{width:50px;}  
    </style>
</head>
<body>
    <h1>Listado de los usuarios</h1>
    <?php
    try{
        $conexion=mysqli_connect("localhost","jose","josefa","bd_foro");
        mysqli_set_charset($conexion,"utf8");
    }
    catch(Exception $e)
    {
        die("<p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p></body></html>");
    }



    try{
        $consulta="select * from usuarios";
        $resultado=mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die("<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p></body></html>");
    }
  
    echo "<table>";
    echo "<tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th></tr>";
    while($tupla=mysqli_fetch_assoc($resultado))
    {
        echo "<tr>";
        echo "<td>".$tupla["nombre"]."</td>";
        echo "<td><img src='images/borrar.png' alt='Imagen de Borrar' title='Borrar Usuario'></td>";
        echo "<td><img src='images/editar.png' alt='Imagen de Editar' title='Editar Usuario'></td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<form action='usuario_nuevo.php' method='post'>";
    echo "<p><button type='submit' name='btnNuevoUsuario'>Insertar nuevo Usuario</button></p>";
    echo "</form>";
  
    mysqli_free_result($resultado);
    mysqli_close($conexion);


    ?>
</body>
</html>