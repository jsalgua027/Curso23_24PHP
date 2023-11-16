<?php


require "src/funciones.php";

if (isset($_POST["btnGuardar"])) { // btnGuardar es btnContinuar

    $error_nombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 50;
    $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 30;
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
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
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
        $error_dni = repetido_variable($conexion, "usuarios", "dni", $_POST["dni"]);

        if (is_string($error_dni))
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }
    $error_sexo = !isset($_POST["sexo"]); // si no existe 


    $error_archivo =  $_FILES["archivo"]["name"] != "" &&  ($_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"])|| !tiene_extension($_FILES["archivo"]["name"]) || $_FILES["archivo"]["size"] > 500 * 1024);


    $error_form = $error_nombre || $error_usuario || $error_clave || $error_dni || $error_sexo || $error_archivo;

    // si no hay ningun error realizo la inserción de datos
    //OJO CON ESTA PARTE QUE ES MUY IMPORTANTE
    if (!$error_form) {

        try {


            $consulta = "insert into usuarios (nombre,usuario,clave,dni,sexo) values ('" . $_POST["nombre"] . "','" . $_POST["usuario"] . "','" . $_POST["clave"] . "','" . $_POST["dni"] . "','" . $_POST["sexo"] . "')";
            mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido insertar los datos: " . $e->getMessage() . "</p>"));
        }
        // una vez que hago eso compruebo si existe el archivo foto, si existe muevo el archivo a la carpeta y si tengo exito hago un pudate con la foto (img_id)
        if ($_FILES["archivo"]["name"] != "") {
            //la id con la ultima insercción
            $las_id = mysqli_insert_id($conexion);
            //cojemos extension de la foto
            $array_nombre = explode(".", $_FILES["archivo"]["name"]);

            if (count($array_nombre) > 1) {
                $ext = "." . end($array_nombre);
            }
            //concateno el nombre de la foto
            $nombre_foto = "img_" . $las_id . $ext;
        }

        // muevo la foto a la carpeta
        @$var = move_uploaded_file($_FILES["archivo"]["tmp_name"], "Img/$nombre_foto");

        if ($var) {
            //aqui hago el update
            try {
                $consulta = "update usuarios set foto='" . $nombre_foto . "' where id_usuario='" . $las_id . "'";
                mysqli_query($conexion, $consulta);
            } catch (Exception $e) {
                //
                unlink("Img/.$nombre_foto");
                mysqli_close($conexion);
                die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido insertar los datos: " . $e->getMessage() . "</p>"));
            }
        }


        mysqli_close($conexion);
        header("Location:index.php");
        exit;
    }
}

if (isset($_POST["btnBorrar"])) {
    //conecto
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die("<p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
    }
    // realizo la consulta borrado
    try {
        $consulta = "delete from usuarios where id_usuario='" . $_POST["btnBorrar"] . "'";
        mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Práctica 8", "<h1>Listado de los usuarios</h1><p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }

    if ($_POST["nombre_foto"] != "no_imagen.jpg")
        unlink("Img/" . $_POST["nombre_foto"]);



    mysqli_close($conexion);
    header("Location:index.php");
    exit();
}

//realizo la conexion

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
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
    </style>
</head>

<body>
    <h1>Práctica 8</h1>
    <?php
    // so le damos al boton detalle
    if (isset($_POST["btnDetalle"])) {
        require("vistas/vista_detalle.php");
    }
    if (isset($_POST["btnNuevoUsu"]) || isset($_POST["btnGuardar"])) {
        require("vistas/vista_nuevo.php");
    }

    // muestro la consulta generaal de la tabla INICIO
    require("vistas/vista_tabla.php");


    ?>
</body>

</html>