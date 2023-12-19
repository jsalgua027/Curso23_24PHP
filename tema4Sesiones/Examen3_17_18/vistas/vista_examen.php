<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Video Club</title>
        <style>
            .enlinea{display:inline}
            .enlace{border:none;background:none;text-decoration:underline;color:blue;cursor:pointer}
            table,td,th{border:1px solid black;}
        table{border-collapse:collapse;text-align:center;width:90%;margin:0 auto}
        th{background-color:#CCC}
        table img{width:50px;}
        </style>
    </head>
    <body>
        <h1>Video Club</h1>
        <div>Bienvenido <strong><?php echo $datos_usuario_logueado["usuario"];?></strong> - 
            <form class='enlinea' action="index.php" method="post">
                <button class='enlace' type="submit" name="btnSalir">Salir</button>
            </form>
        </div>
        <h3>Listado de peliculas</h3>
        <?php
         try{
            $consulta="select * from peliculas ";
            $resultado=mysqli_query($conexion, $consulta);
         }
         catch(Exception $e)
         {
             session_destroy();
             mysqli_close($conexion);
             die("<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p></body></html>");
         }
         //hago la tabla
         echo"<table>";
         echo"<tr><th>id</th><th>titulo</th><th>Caratula</th></tr>";
         while($tupla=mysqli_fetch_assoc($resultado))
         {
            echo"<tr>";
            echo"<td>".$tupla["idPelicula"]."</td>";
            echo"<td>".$tupla["titulo"]."</td>";
            echo"<td><img src='images/".$tupla["caratula"]."' alt=caratula  title='caratula'</td>";

            echo"</tr>";
         }
         echo"</table>";
         mysqli_free_result($resultado);
        
        
        
        ?>
    </body>
    </html>