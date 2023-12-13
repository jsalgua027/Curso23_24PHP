<?php





    if(isset($_POST["btnContInsertar"])) // compruebo errores
    {
        $error_nombre=$_POST["nombre"]==""|| strlen($_POST["nombre"])>30;
        $error_usuario=$_POST["usuario"]==""|| strlen($_POST["usuario"])>20;
        if(!$error_usuario)
        {
            try{
                $conexion=mysqli_connect("localhost","jose","josefa","bd_foro2");
                mysqli_set_charset($conexion,"utf8");
            }
            catch(Exception $e)
            {
                die(error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
            }

            $error_usuario=repetido($conexion,"usuarios","usuario",$_POST["usuario"]);
            
            if(is_string($error_usuario))
                die($error_usuario);

        }

        $error_clave=$_POST["clave"]=="" || strlen($_POST["clave"])>15;
        $error_email=$_POST["email"]=="" || strlen($_POST["email"])>50 || !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);
        if(!$error_email)
        {
            if(!isset($conexion))
            {
                try{
                    $conexion=mysqli_connect("localhost","jose","josefa","bd_foro2");
                    mysqli_set_charset($conexion,"utf8");
                }
                catch(Exception $e)
                {
                    die(error_page("Primer Login","<h1>Práctica 1º CRUD</h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
                }
            }
            $error_email=repetido($conexion,"usuarios","email",$_POST["email"]);
            
            if(is_string($error_email))
                die($error_email);

            
        }
        $error_form=$error_nombre||$error_usuario||$error_clave||$error_email;

        if(!$error_form)
        {
            try{
                $consulta="insert into usuarios (nombre,usuario,clave,email,tipo) values ('".$_POST["nombre"]."','".$_POST["usuario"]."','".md5($_POST["clave"])."','".$_POST["email"]."','".$_POST["tipo"]."')";
                mysqli_query($conexion,$consulta);
            }
            catch(Exception $e)
            {
                mysqli_close($conexion);
                die(error_page("Primer login","<h1>Primer Login</h1><p>No se ha podido hacer la consulta: ".$e->getMessage()."</p>"));
            }
            
            mysqli_close($conexion);

            header("Location:index.php");
            exit;
            
        }

        //Por aquí continuo sólo si hay errores en el formulario

        if(isset($conexion))
            mysqli_close($conexion);
        
    }









if (isset($_POST["btnContBorrar"])) {


    try {
        $consulta = "delete from usuarios where id_usuario='" . $_POST["btnContBorrar"] . "'";
        mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Primer Login", "<h1>Listado de los usuarios</h1><p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }

    mysqli_close($conexion);
    header("Location:index.php");
    exit();
}

?>


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

        td,
        th {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            text-align: center
        }

        th {
            background-color: #CCC
        }

        table img {
            width: 50px;
        }

        .enlace {
            border: none;
            background: none;
            cursor: pointer;
            color: blue;
            text-decoration: underline
        }

        .error {
            color: red
        }

        .noBordes {
            border: none;
        }
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
            echo "<h2>La lista de usuarios Normales</h2>";
            echo "<table>";
            echo "<tr><th>Nombre de Usuario</th><th>Borrar</th><th>Editar</th><th><form action='index.php' method='post'><button class='enlace' type='submit' value='' name='btnNuevoUsuario' title='Nuevo Usuario'>Nuevo Usuario </button></form></th></tr>";
            while ($tupla = mysqli_fetch_assoc($resultado)) {
                echo "<tr>";
                echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnDetalle' title='Detalles del Usuario'>" . $tupla["nombre"] . "</button></form></td>";
                echo "<td><form action='index.php' method='post'><input type='hidden' name='nombre_usuario' value='" . $tupla["nombre"] . "'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnBorrar'><img src='images/borrar2.png' alt='Imagen de Borrar' title='Borrar Usuario'></button></form></td>";
                echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnEditar'><img src='images/editar2.png' alt='Imagen de Editar' title='Editar Usuario'></button></form></td>";
                echo  "<td class='noBordes'></td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($resultado);
            if (isset($_SESSION["mensaje"])) {
                echo "<p class='mensaje'>se ha podido borrar el mensaje</p>";
                unset($_SESSION["mensaje"]);
            }

            if (isset($_POST["btnNuevoUsuario"])) {

                require "usuario_nuevo.php";
            } elseif (isset($_POST["btnDetalle"])) {
                require "vistas/vista_detalle.php";
            } elseif (isset($_POST["btnBorrar"])) {
                require "vistas/vista_conf_borrar.php";
            }
            ?>
    </div>
</body>

</html>