<?php

function error_page($title, $body)
{
    $page = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>' . $title . '</title>
        </head>
        <body>' . $body . ' </body>
        </html>';
    return $page;
}

function repetido($conexion,$tabla,$columna,$valor)
{

  //REALIZO LA CONSULTA
  try {
    $consulta = "select * from ".$tabla." where ".$columna."='" . $valor . "'";
    $resultado = mysqli_query($conexion, $consulta);
    $respuesta=mysqli_num_rows($resultado)>0;
} catch (Exception $e) {

    mysqli_close($conexion);

    $respuesta=error_page("Practica 1 CURD", "<p class='error'>No he podido hacer la consulta " . $e->getMessage() . " </p>");
  
}

return $respuesta;
    
}

if (isset($_POST["btnNuevoUsuario"]) || isset($_POST["btnConInsertar"])) {  //la condicion de insertar es por si hay errores al darle continuar y hay errores

    //si pulso insertar controlo error del formulario de esta pagina

    if (isset($_POST["btnConInsertar"])) {
        $error_nombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 30;
        $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 20;
        //si no hay error en el usuario compruebo en la base de datos que no este repetido
        if (!$error_usuario) {
            // REALIZO LA CONEXION
            try {
                $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
                // traduce los caracteres de la base de datos a nuestro codigo; hay que hacerlo 
                mysqli_set_charset($conexion, "utf8");
            } catch (Exception $e) {

                //si no logro conectarme
                //OJO el die termina todo  y le paso a mi metodo el titulo y el body
                die(error_page("Practica 1 CURD", "<p class='error'>No he podido conectarme a la base de datos: " . $e->getMessage() . " </p>"));
            }

         $error_usuario= repetido($conexion,"usuarios","usuario",$_POST["usuario"]);

            if(is_string($error_usuario)){
              
                die($error_usuario);

            }
           


        }



        $error_clave = $_POST["clave"] == "" || strlen($_POST["clave"]) > 15;
        //si esta vacio o no pasa el filtro
        $error_email = $_POST["email"] == "" || strlen($_POST["email"]) > 50 || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        if (!$error_email) {
            //si no hay conexexion conectate
            if (!isset($conexion)) {
                // REALIZO LA CONEXION
                try {
                    $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
                    // traduce los caracteres de la base de datos a nuestro codigo; hay que hacerlo 
                    mysqli_set_charset($conexion, "utf8");
                } catch (Exception $e) {

                    //si no logro conectarme
                    //OJO el die termina todo  y le paso a mi metodo el titulo y el body
                    die(error_page("Practica 1 CURD", "<p class='error'>No he podido conectarme a la base de datos: " . $e->getMessage() . " </p>"));
                }
            }
            //REALIZO LA CONSULTA
            $error_email= repetido($conexion,"usuarios","usuario",$_POST["email"]);

            if(is_string($error_email))
            die($error_email);

        }

        $error_form = $error_nombre || $error_usuario || $error_clave || $error_email;

        if (!$error_form) {
            //los header location hay que hacerlos antes de escibir el hmtl

         
            try {
                $consulta="insert into usuario (nombre,usuario,clave,email) values ('".$_POST["nombre"]."','".$_POST["usuario"]."','".md5($_POST["clave"])."','".$_POST["email"]."'))";
               mysqli_query($conexion, $consulta);
            } catch (Exception $e) {



                die(error_page("Practica 1 CURD", "<p class='error'>No he podido hacer la consulta " . $e->getMessage() . " </p>"));
                // si falla , cierro conexión
                mysqli_close($conexion);
            }

            mysqli_close($conexion);

            header("Location:index.php");
        }
        // por aqui continuo solo si hay errores en el formulario
        if(isset($conexion)){
            mysqli_close($conexion);

        }



    }



?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Practica 1 CURD</title>
        <style>
            .error {
                color: red;

            }
        </style>
    </head>

    <body>
        <h1>Nuevo Usuario</h1>

        <form action="usuario_nuevo.php" method="post">
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
                <?php
                if (isset($_POST["btnConInsertar"]) && $error_nombre) {
                    if ($_POST["nombre"] == "")
                        echo "<span class='error'>Campo vacio</span>";
                    else {

                        echo "<span class='error'>Has superado los 30 caracteres</span>";
                    }
                }


                ?>


            </p>
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">

                <?php
                if (isset($_POST["btnConInsertar"]) && $error_usuario) {
                    if ($_POST["usuario"] == "")
                        echo "<span class='error'>Campo vacio</span>";
                    elseif (strlen($_POST["usuario"]) > 20) {

                        echo "<span class='error'>Has superado los 20 caracteres</span>";
                    }
                }

                ?>
            </p>

            <p>
                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" maxlength="15">
            </p>

            <p>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"] ?>">
                <?php
                if (isset($_POST["btnConInsertar"]) && $error_email) {
                    if ($_POST["nombre"] == "") {

                        echo "<span class='error'>Campo vacio</span>";
                    } elseif (strlen($_POST["email"]) > 50) {

                        echo "<span class='error'>Has superado los 50 caracteres</span>";
                    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                        echo "<span class='error'>error sintactico</span>";
                    } else {
                        echo "<span class='error'>El campo no tiene el formato valido</span>";
                    }
                }


                ?>



            </p>


            <p>

                <button type="submit" name="btnConInsertar">Continuar</button>
                <button type="submit" name="btnVolver">Volver</button>
            </p>


        </form>

    </body>

    </html>


<?php
} else {

    header("Location:index.php");
    exit;
}

?>