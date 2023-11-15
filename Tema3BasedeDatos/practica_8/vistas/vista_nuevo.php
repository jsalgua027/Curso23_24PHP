<?php
// llamo a la pagina con mis funciones 

require "src/funciones.php";

if (isset($_POST["btnGuardar"])) {

    $error_nombre = $_POST["nombre"] = "" || strlen($_POST["nombre"]) > 50;
    $error_usuario = $_POST["usuario"] = "" || strlen($_POST["usuario"]) > 30;
    // si no hay error en el usuario compruebo que no este repetido
    if (!$error_usuario) {
        try {
            $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }
        $error_usuario = repetido_variable($conexion, "usuarios", "usuario", $_POST["usuario"]);

        if (is_string($error_usuario))
            die($error_usuario);
    }
    $error_clave = $_POST["clave"] == "" || strlen($_POST["clave"]) > 50;
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
    // compruebo que el dni no este repetido 
    if (!$error_dni) {

        try {
            $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }
        $error_dni = repetido_variable($conexion, "usuarios", "usuario", $_POST["dni"]);

        if (is_string($error_dni))
            die($error_dni);
    }
    $error_sexo = !isset($_POST["sexo"]); // si no existe 
    $error_archivo =  $_FILES["archivo"]["name"] != "" &&  ($_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024);

    $error_form = $error_nombre || $error_usuario || $error_clave || $error_dni || $error_sexo || $error_archivo;

    // si no hay ningun error realizo la inserción de datos

    if (!$error_form) {

        try {
          
           $consulta = "insert into usuarios (nombre,usuario,clave,dni,sexo) values ('" . $_POST["nombre"] . "','" . $_POST["usuario"] . "','" . $_POST["clave"] . "','" . $_POST["dni"] . "','" . $_POST["sexo"] . "')";
           mysqli_query($conexion,$consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }
        mysqli_close($conexion);

        header("Location:index.php");
        exit;
        // tengo que hacer el primer insert sin foto
        // una vez que hago eso compruebo si existe el archivo foto, si existe muevo el archivo a la carpeta y si tengo exito hago un pudate con la foto (img_id)
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
    <style>
        .erro {
            color: red
        }
    </style>
</head>

<body>
    <h2>Agregar Nuevo Usuario</h2>
    <form action="vista_nuevo.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre</label></br>
            <input type="text" name="nombre" id="nombre" maxlength="50" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"]; ?>">
            <?php
            if (isset($_POST["btnGuardar"]) && $error_nombre) {
                if ($_POST["nombre"] == "")
                    echo "<span class='error'> Campo vacío</span>";
                else
                    echo "<span class='error'> Has tecleado más de 30 caracteres</span>";
            }
            ?>
        </p>
        <p>
            <label for="usuario">Usuario</label></br>
            <input type="text" name="usuario" id="usuario" maxlength="30" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>">
            <?php
            if (isset($_POST["btnGuardar"]) && $error_usuario) {
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
            <label for="clave">Contraseña</label></br>
            <input type="password" name="clave" id="clave" maxlength="50"><!--NO pongo value poque no se guarda la contraseña si hay error, la tiene que escribir otra vez-->
            <?php
            if (isset($_POST["btnGuardar"]) && $error_clave) {
                if ($_POST["clave"] == "")
                    echo "<span class='error'> Campo vacío</span>";
                else
                    echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
            }
            ?>
        </p>
        <p>
            <label for="dni">DNI</label></br>
            <input type="text" name="dni" id="dni" maxlength="50" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
            <?php

            if (isset($_POST["btnGuardar"]) && $error_dni) {
                if ($_POST["dni"] == "")
                    echo "<span class='error'>Campo vacio </span>";
                elseif (!dni_bien_escrito((strtoupper($_POST["dni"])))) {
                    echo "<span class='error'>El dni no esta bien escrito </span>";
                } else {

                    echo "<span class='error'>El dni no es valido </span>";
                }
            }


            ?>
        </p>
        <p>
            <label for="sexo">Sexo</label></br>
            <?php
            if (isset($_POST["btnGuardar"]) && $error_sexo) {
                echo "<span class='error'>Debe de seleccionar un sexo </span> </br>";
            }
            ?>
            <input type="radio" <?php if (isset($_POST['sexo']) && $_POST['sexo'] == 'hombre') echo 'checked'; ?> name="hombre" value="hombre">
            <label for="hombre">Hombre</label></br>
            <input type="radio" <?php if (isset($_POST['sexo']) && $_POST['sexo'] == 'mujer') echo 'checked'; ?> name="mujer" value="mujer">
            <label for="hombre">mujer</label>

        </p>
        <p>
            <label for="archivo">Seleccione un archivo imagen(Max 500KB)</label>
            <input type="file" name="archivo" id="archivo" accept="image/*">
            <?php
            // le damos al boton y hay un error....¿pero cual?
            if (isset($_POST["btnGuardar"]) && $error_archivo) {
                // si hay un error al subir al servidor (vemos los errores)
                if ($_FILES["archivo"]["name"] != "") {
                    // si no se almacena correctamente al servidor
                    if ($_FILES["archivo"]["error"]) {
                        echo "<span class='error'> No se ha podido subir el archivo al servidor</span>";
                    } elseif (!getimagesize($_FILES["archivo"]["tmp_name"])) {

                        echo "<span class='error'>El archivo seleccionado no es una fotografia</span>";
                    } else {
                        // si te pasas de tamanio
                        echo "<span class='error'> El archivo seleccionado supera los 500 MAX</span>";
                    }
                }
            }
            ?>
        </p>

        <p>
            <button type="submit" name="btnGuardar">Guardar Cambios</button>
            <button type="submit" name="atras">Atrás</button>

        </p>
    </form>


</body>

</html>


