<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>
        .enlinea {
            display: inline
        }

        .enlace {
            border: none;
            background: none;
            text-decoration: underline;
            color: blue;
            cursor: pointer
        }
       
        table,td,th{border:1px solid black}
        table{border-collapse:collapse;text-align:center}
        th{background-color:#CCC}
        table img{width:50px;}
        .enlace{border:none;background:none;cursor:pointer;color:blue;text-decoration:underline}
        .error{color:red}  
   
    </style>
</head>

<body>
    <h1>Primer Login - Vista Admin</h1>
    <div>Bienvenido <strong><?php echo $datos_usuario_logueado["nombre"]; ?></strong> -
        <form class='enlinea' action="index.php" method="post">
            <button class='enlace' type="submit" name="btnSalir">Salir</button>
        </form>
    </div>
    <div><?php
            if (!isset($conexion)) {
                try {
                    $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
                    mysqli_set_charset($conexion, "utf8");
                } catch (Exception $e) {
                    die("<p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
                }
            }

            try {
                $consulta = "select * from usuarios where tipo='normal'";
                $resultado = mysqli_query($conexion, $consulta);
            } catch (Exception $e) {
                mysqli_close($conexion);
                die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
            }
            echo"<h2>La lista de usuarios Normales</h2>";
            echo "<table>";
            echo "<tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th><th><form action='index.php' method='post'><button class='enlace' type='submit' value='' name='btnNuevoUsuario' title='Nuevo Usuario'>Nuevo Usuario </button></form></th></tr>";
            while ($tupla = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnDetalle' title='Detalles del Usuario'>" . $tupla["nombre"] . "</button></form></td>";
                echo "<td><form action='index.php' method='post'><input type='hidden' name='nombre_usuario' value='" . $tupla["nombre"] . "'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnBorrar'><img src='images/borrar2.png' alt='Imagen de Borrar' title='Borrar Usuario'></button></form></td>";
                echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnEditar'><img src='images/editar2.png' alt='Imagen de Editar' title='Editar Usuario'></button></form></td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($resultado);

            if(isset($_POST["btnNuevoUsuario"])){

          
               require "usuario_nuevo.php";

           
            }
            ?>
    </div>
</body>
</html>