<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1 CRUD</title>

    <style>
        table, th, td{border: 1px solid black;}
        table{ border-collapse: collapse; text-align: center;}
        th{background-color: #ccc;}
            table img{
                width: 75px;

            }

    </style>
</head>
<body>
    <h1>Listado de usuarios</h1>


    <?php
    // REALIZO LA CONEXION
    try {
        $conexion=mysqli_connect("localhost","jose","josefa","bd_foro");
        // traduce los caracteres de la base de datos a nuestro codigo; hay que hacerlo 
        mysqli_set_charset($conexion,"utf8");
    } catch (Exception $e) {
        
        //si no logro conectarme
                                                                //OJO el die termina todo y necesita un fin de body y de html
        die("<p class='error'>No he podido conectarme a la base de datos: ".$e->getMessage()." </p></body></html>");
    }

    //REALIZO LA CONSULTA
    try {
        $consulta="select * from usuarios";
        $resultado=mysqli_query($conexion,$consulta);
        
    } catch (Exception $e) {
        
        
                                                               
        die("<p class='error'>No he podido realizar la consulta: ".$e->getMessage()." </p></body></html>");
         // si falla , cierro conexión
         mysqli_close($conexion);
    }


    //IMPRIMO LA CONSULTA
    echo "<table>";
    echo "<tr><th>Nombre Usuario</th><th>Borrar</th><th>Editar</th></tr>";
    //recorro los datos
    while ($tupla=mysqli_fetch_assoc($resultado)) {
        echo"<tr>";
        echo"<td>".$tupla["nombre"]."</td>";
        echo"<td><img src='images/borrar2.png' alt= 'Imagen borrar'></td>";
        echo"<td><img src='images/editar2.png' alt= 'Editar borrar'></td>";
        
       echo"</tr>";
    }
    echo "</table>";

    echo "<form action= 'usuario_nuevo.php'  method='post'>";
    echo "<p><button type='submit' name='btnNuevoUsuario'>Insertar nuevo usuario</button></p>";
    echo "</form>";
  

    //cierro conexión
    mysqli_close($conexion)
    
    ?>
</body>
</html>