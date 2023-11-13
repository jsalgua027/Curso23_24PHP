<?php


require "src/ctes_funciones.php";


// control de errores de boton continuar
// con la consulta del update
if (isset($_POST["btnConEditar"])) {
    $error_nombre=$_POST["nombre"]==""|| strlen($_POST["nombre"])>30;
        $error_usuario=$_POST["usuario"]==""|| strlen($_POST["usuario"])>20;
        //si no hay error en el usuario compruebo en la base de datos que no este repetido
        if(!$error_usuario){

            try{
                $conexion=mysqli_connect("localhost","jose","josefa","bd_foro");
                 // traduce los caracteres de la base de datos a nuestro codigo; hay que hacerlo 
                mysqli_set_charset($conexion,"utf8");
            }
            catch(Exception $e)
            {
                //si no logro conectarme
                //OJO el die termina todo  y le paso a mi metodo el titulo y el body
                die(error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
            }

            $error_usuario=repetido_editando($conexion,"usuarios","usuario",$_POST["usuario"], "id_usuario",$_POST["btnConEditar"]);
            
            if(is_string($error_usuario)){
                die($error_usuario);
            }
            


        }
        
        $error_clave=$_POST["clave"]=="" || strlen($_POST["clave"])>15;
        $error_email=$_POST["email"]=="" || strlen($_POST["email"])>50 || !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);
        if(!$error_email)
        {
             //si no hay conexexion conectate
            if(!isset($conexion))
            {
                 // REALIZO LA CONEXION
                try{
                    $conexion=mysqli_connect("localhost","jose","josefa","bd_foro");
                    mysqli_set_charset($conexion,"utf8");
                }
                catch(Exception $e)
                {
                    die(error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
                }
            }
             //REALIZO LA CONSULTA
            $error_email=repetido($conexion,"usuarios","email",$_POST["email"]);
            
            if(is_string($error_email))
                die($error_email);
            
        }     

        $error_form=$error_nombre||$error_usuario||$error_clave||$error_email;
        if(!$error_form)
        {
            try{
                if($_POST["clave"==""]){
                    $consulta="update usuarios set nombre='".$_POST["nombre"]."', usuario='".$_POST["usuario"]."' , email='".$_POST["email"]."' where id_usuario='".$_POST["btnConEditar"]."'";
                }else{
                    $consulta="update usuarios set nombre='".$_POST["nombre"]."', usuario='".$_POST["usuario"]."' ', clave='".md5($_POST["clave"])."', email='".$_POST["email"]."' where id_usuario='".$_POST["btnConEditar"]."'";
                    mysqli_query($conexion,$consulta);
                }
                }

                            
            catch(Exception $e)
            {
                mysqli_close($conexion);
                die(error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No se ha podido hacer la consulta: ".$e->getMessage()."</p>"));
            }
              // si falla , cierro conexión
            mysqli_close($conexion);

            header("Location:index.php");
            exit;
            
        }        
        

    }
    


if (isset($_POST["btnContBorrar"])) {
    echo "<h1>entro en borrar</h1>";
    // REALIZO LA CONEXION
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        // traduce los caracteres de la base de datos a nuestro codigo; hay que hacerlo 
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {

        //si no logro conectarme
        //OJO el die termina todo y necesita un fin de body y de html
        die(error_page("Practica 1 CRUD", "<h1>Listado de Usuarios</h1><p>No he podido conectarme a la base de datos: " . $e->getMessage() . " </p></body></html>"));
    }


    try {
        $consulta = "delete from usuarios where id_usuario ='" . $_POST["btnContBorrar"] . "'";
        mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Práctica 1º CRUD", "<h1>Listado de Usuarios</h1><p>No se ha podido hacer la consulta: " . $e->getMessage() . "</p>"));
    }

    // si falla , cierro conexión
    mysqli_close($conexion);

    header("Location:index.php");
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1 CRUD</title>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: #ccc;
        }

        table img {
            width: 75px;

        }

        .enlace {

            border: none;
            background: none;
            cursor: pointer;
            color: blue;

        }
    </style>
</head>

<body>
    <h1>Listado de usuarios</h1>


    <?php
    // REALIZO LA CONEXION
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        // traduce los caracteres de la base de datos a nuestro codigo; hay que hacerlo 
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {

        //si no logro conectarme
        //OJO el die termina todo y necesita un fin de body y de html
        die("<p class='error'>No he podido conectarme a la base de datos: " . $e->getMessage() . " </p></body></html>");
    }

    //REALIZO LA CONSULTA
    try {
        $consulta = "select * from usuarios";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {



        die("<p class='error'>No he podido realizar la consulta: " . $e->getMessage() . " </p></body></html>");
        // si falla , cierro conexión
        mysqli_close($conexion);
    }


    //IMPRIMO LA CONSULTA
    echo "<table>";
    echo "<tr><th>Nombre Usuario</th><th>Borrar</th><th>Editar</th></tr>";
    //recorro los datos
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnDetalle'>" . $tupla["nombre"] . "</form></td>";
        echo "<td><form action='index.php' method='post'><input type='hidden' name='nombre_usuario' value='" . $tupla["nombre"] . "'><button type='submit' value='" . $tupla["id_usuario"] . "' name='btnBorrar'><img src='images/borrar2.png' alt= 'Imagen borrar'></button></form></td>";
        echo "<td><form action='index.php' method='post'><button type='submit' value='" . $tupla["id_usuario"] . "' name='btnEditar'><img src='images/editar2.png' alt= 'Editar borrar'></button></form></td>";

        echo "</tr>";
    }
    echo "</table>";


    if (isset($_POST["btnDetalle"])) {

        echo "<h3>Detalles del usuario con id:  " . $_POST["btnDetalle"] . "</h3>";

        //REALIZO LA CONSULTA
        try {
            $consulta = "select * from usuarios where id_usuario='" . $_POST["btnDetalle"] . "'";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {



            die("<p class='error'>No he podido realizar la consulta: " . $e->getMessage() . " </p></body></html>");
            // si falla , cierro conexión
            mysqli_close($conexion);
        }

        if (mysqli_num_rows($resultado) > 0) {

            $datos_usuarios = mysqli_fetch_assoc($resultado);


            echo "<p>";
            echo "<strong>Nombre: </strong>" . $datos_usuarios["nombre"] . "</br>";
            echo "<strong>Usuaio: </strong>" . $datos_usuarios["usuario"] . "</br>";
            echo "<strong>Email </strong>" . $datos_usuarios["email"] . "</br>";
            echo "</p>";
        } else {

            echo "<p>El usuario seleccionado no se encuentra registrado en la base de datos</p>";
        }


        //boton para volver al index
        echo "<form action= 'index.php'  method='post'>";
        echo "<p><button type='submit'>Volver</button></p>";
        echo "</form>";
        // si le da al boton borrar
    } elseif (isset($_POST["btnBorrar"])) {

        echo "<p>Se dispone a borrar al ausuario:  <strong>" . $_POST["nombre_usuario"] . "</strong></p>";
        echo "<form action='index.php' method='post'>";
        echo "<p><button type='submit' name='btnContBorrar' value='" . $_POST["btnBorrar"] . "'>Continuar</button>";
        echo "<button type='submit' name='atras'>Atras</button></p>";
        echo "</form>";
    } elseif (isset($_POST["btnEditar"]) || isset($_POST["btnConEditar"])) {

        if (isset($_POST["btnEditar"])) {
            $id_usuario = $_POST["btnEditar"];
        } else {

            $id_usuario = $_POST["btnConEditar"];
        }

        // nuevo formulario 
        //trareme los valores a los values de los imputs del nuevo formulario con una conexion y una consulta
        echo "<h3>El usuario ha editar tiene el  id:  " . $_POST["btnEditar"] . "</h3>";

        //REALIZO LA CONSULTA
        try {
            $consulta = "select * from usuarios where id_usuario='" . $_POST["btnEditar"] . "'";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {



            die("<p class='error'>No he podido realizar la consulta: " . $e->getMessage() . " </p></body></html>");
            // si falla , cierro conexión
            mysqli_close($conexion);
        }


        // recojo los datos
        if (mysqli_num_rows($resultado) > 0) {

            if (isset($_POST["btnEditar"])){
            $datos_usuarios = mysqli_fetch_assoc($resultado);
            $id_usuario = $datos_usuarios["id_usuario"];
            $nombre = $datos_usuarios["nombre"];
            $usuario = $datos_usuarios["usuario"];
            //$clave=$datos_usuarios["clave"];
            $email = $datos_usuarios["email"];
            // mysqli_free_result($resultado);
            }else{

                
            $nombre = $_POST["nombre"];
            $usuario =$_POST["usuario"];
            $email = $_POST["email"];

            }
            


        } else {

            $menseja_erro_usuario = "<p>El usuario seleccionado no se encuentra registrado en la base de datos</p>";
        }

        if (isset($menseja_erro_usuario)) {
            echo $menseja_erro_usuario;
        } else {

    ?>
            <h2>Editando al Usuario <?php echo $id_usuario; ?></h2>
            <form action="index.php" method="post">
                <p>
                    <label for="nombre">Nombre: </label>
                    <input type="text" name="nombre" id="nombre" maxlength="30" value="<?php echo $nombre; ?>">
                    <?php
                    if (isset($_POST["btnContEditar"]) && $error_nombre) {
                        if ($_POST["nombre"] == "")
                            echo "<span class='error'> Campo vacío</span>";
                        else
                            echo "<span class='error'> Has tecleado más de 30 caracteres</span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="usuario">Usuario: </label>
                    <input type="text" name="usuario" id="usuario" maxlength="20" value="<?php echo $usuario; ?>">
                    <?php
                    if (isset($_POST["btnContEditar"]) && $error_usuario) {
                        if ($_POST["usuario"] == "")
                            echo "<span class='error'> Campo vacío</span>";
                        elseif (strlen($_POST["usuario"]) > 20)
                            echo "<span class='error'> Has tecleado más de 20 caracteres</span>";
                        else
                            echo "<span class='error'> Usuario repetido</span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="clave">Contraseña: </label>
                    <input type="password" name="clave" maxlength="15" id="clave" placeholder="Editar Contraseña">
                    <?php
                    if (isset($_POST["btnContEditar"]) && $error_clave) {

                        echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="email">Email: </label>
                    <input type="text" name="email" id="email" maxlength="50" value="<?php echo $email; ?>">
                    <?php
                    if (isset($_POST["btnContEditar"]) && $error_email) {
                        if ($_POST["email"] == "")
                            echo "<span class='error'> Campo vacío</span>";
                        elseif (strlen($_POST["email"]) > 50)
                            echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
                        elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
                            echo "<span class='error'> Email sintáxticamente incorrecto</span>";
                        else
                            echo "<span class='error'> Email repetido</span>";
                    }
                    ?>
                </p>
                <p>
                    <button type="submit" name="btnContEditar" value="<?php $id_usuario; ?>">Continuar</button>
                    <button type="submit" name="btnVolver">Volver</button>
                </p>
            </form>




    <?php
            // meter los botones 
            //controlar los errores de de campos
            if (isset($_POST["atras"])) {
                mysqli_close($conexion);
                header("location: index.php");
            }
        }
    } else {

        echo "<form action= 'usuario_nuevo.php'  method='post'>";
        echo "<p><button type='submit' name='btnNuevoUsuario'>Insertar nuevo usuario</button></p>";
        echo "</form>";
    }


    //cierro conexión
    mysqli_close($conexion);


    ?>
</body>

</html>