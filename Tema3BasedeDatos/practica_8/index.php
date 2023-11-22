<?php

require "src/funciones.php";
session_start();

if (isset($_POST["btnContBorrarFoto"])) {

    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }
    try {
        $consulta = "update usuarios set foto='no_image.jpg' where id_usuario='" . $_POST["id_usuario"] . "'";
        mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        //Al no poder actualizar borro la nueva que acabo de mover

        mysqli_close($conexion);
        die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
    if (file_exists("Img/" . $_POST["foto_bd"])) {
        unlink("Img/" . $_POST["foto_bd"]);
    }
    $_POST["foto_bd"] = "no_imagen.jpg";
}

if (isset($_POST["btnConEditar"])) {
    //aqui el control de errores de continuar editar

    //nombre y usuario (btnCinEditar)
    $error_nombre = $_POST["nombre"] == "" || strlen($_POST["nombre"]) > 50;
    $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 50;
    if (!$error_usuario) {
        try {
            $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }

        $error_usuario = repetido_variable($conexion, "usuarios", "usuario", $_POST["usuario"], "id_usuario", $_POST["id_usuario"]);

        if (is_string($error_usuario)) {
            mysqli_close($conexion);
            die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No se ha podido realizar la consulta: " . $error_usuario . "</p>"));
        }
    }
    // clave dni fotos
    $error_clave = strlen($_POST["clave"]) > 15;

    $dni_may = strtoupper($_POST["dni"]);
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito($dni_may) || !dni_valido($dni_may);
    if (!$error_dni) {
        if (!isset($conexion)) {
            try {
                $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
                mysqli_set_charset($conexion, "utf8");
            } catch (Exception $e) {
                die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
            }
        }
        $error_dni = repetido_variable($conexion, "usuarios", "dni", $dni_may, "id_usuario", $_POST["id_usuario"]);

        if (is_string($error_dni)) {
            mysqli_close($conexion);
            die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No ha podido realizarse la consulta: " . $error_dni . "</p>"));
        }
    }
    $error_archivo = $_FILES["archivo"]["name"] != "" && ($_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || !tiene_extension($_FILES["archivo"]["name"]) || $_FILES["archivo"]["size"] > 500 * 1024);

    $error_form = $error_nombre || $error_usuario || $error_clave || $error_dni || $error_archivo;
    // si no hay error
    if (!$error_form) {
        //TODO el código para actualizar
        try {

            if ($_POST["clave"] == "") // si no esta rellenado la clave
            {
                $consulta = "update usuarios set nombre='" . $_POST["nombre"] . "', usuario='" . $_POST["usuario"] . "', dni='" . $dni_may . "' where id_usuario='" . $_POST["id_usuario"] . "'";
            } else {
                $consulta = "update usuarios set nombre='" . $_POST["nombre"] . "', usuario='" . $_POST["usuario"] . "', clave='" . md5($_POST["clave"]) . "', dni='" . $dni_may . "' where id_usuario='" . $_POST["id_usuario"] . "'";
            }

            mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Práctica 1º CRUD", "<h1>Práctica 1º CRUD</h1><p>No se ha podido realizar la consulta:" . $e->getMessage() . "</p>"));
        }

        if ($_FILES["archivo"]["name"] != "") { // si tiene foto seleccionada

            $array_nombre = explode(".", $_FILES["archivo"]["name"]);
            $nombre_foto = "img_" . $_POST["id_usuario"] . "." . end($array_nombre);

            @$var = move_uploaded_file($_FILES["archivo"]["tmp_name"], "Img/" . $nombre_foto);
            if ($var) {
                if ($_POST["foto_bd"] != $nombre_foto) {
                    //Actualizo en BD
                    try {
                        $consulta = "update usuarios set foto='" . $nombre_foto . "' where id_usuario='" . $_POST["id_usuario"] . "'";
                        mysqli_query($conexion, $consulta);
                    } catch (Exception $e) {
                        //Al no poder actualizar borro la nueva que acabo de mover
                        unlink("Img/" . $nombre_foto);
                        mysqli_close($conexion);
                        die(error_page("Práctica 8", "<h1>Práctica 8</h1><p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
                    }
                    //Borro la antigua que había con otra extensión
                    unlink("Img/" . $_POST["foto_bd"]);
                }
            }
        }

        mysqli_close($conexion);
        $_SESSION="Usuario editado con exito";
        header("Location:index.php");
        exit;
    }
}

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

        if (is_string($error_usuario)) {
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }
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

        if (is_string($error_dni)) {
            die(error_page("Práctica 8", "<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }
    }
    $error_sexo = !isset($_POST["sexo"]); // si no existe

    $error_archivo = $_FILES["archivo"]["name"] != "" && ($_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || !tiene_extension($_FILES["archivo"]["name"]) || $_FILES["archivo"]["size"] > 500 * 1024);

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
                //si no he podido hace la actualización
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

    if ($_POST["nombre_foto"] != "no_imagen.jpg") {
        unlink("Img/" . $_POST["nombre_foto"]);
    }

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
            background-color: #CCC;
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

        .paralelo {

            display: flex;
        }

        .fotodetalle2 {

            height: 50px;
        }

        .centrado {
            text-align: center;

        }
        .mensaje{color:blue;font-size: 1rem;}
    </style>
</head>

<body>
    <h1>Práctica 8</h1>
    <?php
    // so le damos al boton detalle
    if (isset($_POST["btnDetalle"])) {
        require "vistas/vista_detalle.php";
    }
    if (isset($_POST["btnNuevoUsu"]) || isset($_POST["btnGuardar"])) {
        require "vistas/vista_nuevo.php";
    }
    //gestión de EDITAR
    if (isset($_POST["btnEditar"]) || isset($_POST["btnConEditar"]) || isset($_POST["btnBorrarFoto"]) || isset($_POSt["btnNoBorrarFoto"]) || isset($_POST["id_usuario"])) {
      require("vistas/vista_editar.php");
    }
    if(isset($_SESSION["mensaje"])){
        echo"<p class='mensaje'>".$_SESSION["mensaje"]."</p>";
        session_destroy();
    }
    // muestro la consulta generaal de la tabla INICIO
    require "vistas/vista_tabla.php";
    ?>
</body>
</html>