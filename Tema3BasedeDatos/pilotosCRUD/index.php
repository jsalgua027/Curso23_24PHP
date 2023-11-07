<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pilotos</title>
    <style>
        table, th, td {
            border: 1px solid black;
            text-align: center;
           
        }
        table{
            border-collapse: collapse;
        }
        table img{
            width: 60px;
        }
        th{

            background-color: lightgray;
        }
    </style>
</head>
<body>
    <h1>Listado de Pilotos</h1>
    <?php
        //realizo la conexión

        try {
            $conexion=mysqli_connect("localhost","jose","josefa","bd_f1");
            mysqli_set_charset($conexion,"utf8");
            echo"<p>Se ha realizado la conexion con exito</p>";
        } catch (Exception $e) {
            die("<p class='error'> No se ha podido conectarme a la base de datos: ".$e->getMessage() ."</p></body></html>");
        }

        // realizo la consulta
        try {
            $consulta= "select * from pilotos";
            // el resultado es el query de la conexion y la consulya
            $resultado= mysqli_query($conexion,$consulta);
        } catch (Exception $e) {
            die("<p class='error'> No se ha podido hacer la consulta: ".$e->getMessage() ."</p></body></html>");
            // como no se ha podido hacer la consulta pero si hemos conectado
            // cerramos la conexio¡ón
            mysqli_close($conexion);
        }

        // imprimo la consulta
        echo"<table>";
        echo"<tr><th>Nombre Piloto</th><th>Borrar</th><th>Editar</th></tr>";
        while ($tupla=mysqli_fetch_assoc($resultado)) {
            echo"<tr>";
            echo"<td>".$tupla["nombre"]."</td>";
            echo"<td><img src='images/borrar.png' atl='borrado'></td>";
            echo"<td><img src='images/editar.png' atl='borrado'></td>";
            echo"</tr>";
        }
        echo"</table>";



    
    ?>
    
</body>
</html>