<?php

require "src/funciones.php";
if(isset($_POST["btnContBorrarFoto"])){

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
   if(file_exists())
    unlink("Img/" . $_POST["foto_bd"]);
    $_post["foto_bd"]="no_imagen.jpg";
}

if (isset($_post["btnConEditar"])) {
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

        $error_usuario = repetido_variable($conexion, "usuarios", "usuario", $_POST["usuario"], "id_usuario", $_POST["btnContEditar"]);

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
        $error_dni = repetido_variable($conexion, "usuarios", "dni", $dni_may, "id_usuario", $_POST["btnContEditar"]);

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
                $consulta = "update usuarios set nombre='" . $_POST["nombre"] . "', usuario='" . $_POST["usuario"] . "', dni='" . $dni_may . "' where id_usuario='" . $_POST["btnContEditar"] . "'";
            } else {
                $consulta = "update usuarios set nombre='" . $_POST["nombre"] . "', usuario='" . $_POST["usuario"] . "', clave='" . md5($_POST["clave"]) . "', dni='" . $dni_may . "' where id_usuario='" . $_POST["btnContEditar"] . "'";
            }

            mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Práctica 1º CRUD", "<h1>Práctica 1º CRUD</h1><p>No se ha podido realizar la consulta:" . $e->getMessage() . "</p>"));
        }

        if ($_FILES["archivo"]["name"] != "") { // si tiene foto seleccionada

            $array_nombre = explode(".", $_FILES["archivo"]["name"]);
            $nombre_foto = "img_" . $_POST["btnContEditar"] . "." . end($array_nombre);

            @$var = move_uploaded_file($_FILES["archivo"]["tmp_name"], "Img/" . $nombre_foto);
            if ($var) {
                if ($_POST["foto_bd"] != $nombre_foto) {
                    //Actualizo en BD
                    try {
                        $consulta = "update usuarios set foto='" . $nombre_foto . "' where id_usuario='" . $_POST["btnContEditar"] . "'";
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

        .paralelo {

            display: flex;
        }

        .fotodetalle2 {

            width: 50px;
        }

        .centrado {
            text-align: center;

        }
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

        if (isset($_POST["btnEditar"])) {
            $id_usuario = $_POST["btnEditar"];
       
        } else {
            $id_usuario = $_POST["id_usuario"];
        }
        //abro conexión si no
        if (!isset($conexion)) {

            try {
                $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
                mysqli_set_charset($conexion, "utf8");
            } catch (Exception $e) {
                die("<p>No se ha podido conectarse a la base de datos: " . $e->getMessage() . "</p></body></html>");
            }
        }
        try {
            $consulta = "select * from usuarios where id_usuario='" . $id_usuario . "'";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
        }
        if (mysqli_num_rows($resultado) > 0) {
            //recojo datos
            if (isset($_POST["btnEditar"])) {
                $datos_usuario = mysqli_fetch_assoc($resultado);
                mysqli_free_result($resultado);
                $nombre = $datos_usuario["nombre"];
                $usuario = $datos_usuario["usuario"];
                $dni = $datos_usuario["dni"];
                $sexo = $datos_usuario["sexo"];
                $foto = $datos_usuario["foto"]; //la foto la saco de la base de datos
            } else {
                //recojo del $_post

                $nombre = $_POST["nombre"];
                $usuario = $_POST["usuario"];
                $dni = $_POST["dni"];
                $sexo = $_POST["sexo"];
                $foto = $_POST["foto_bd"]; // lo meto en un hidden porque en el $_POST no está
            }
        } else {
            $error_existencia = "<p>El usuario seleccionado no se encuentra en la base de datos</p>";
        }
        if (isset($error_existencia)) {
            echo "<p>Editando el usuario" . $id_usuario . "</p>";
            echo $error_existencia;
            echo "<form action='index.php' method='post'>";
            echo "<p><button type='submit'>Volver</button></p>";
            echo "</form>";
        } else {
            // pongo el formulario
    ?>
            <h2>editando el usuario con id <?php echo $id_usuario ?> </h2>
            <div class="paralelo">
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <p>
                        <label for="nombre">Nombre</label></br>
                        <input type="text" name="nombre" id="nombre" maxlength="50" value="<?php echo $nombre; ?>">
                        <?php
                        if (isset($_POST["btnConEditar"]) && $error_nombre) {
                            if ($_POST["nombre"] == "") {
                                echo "<span class='error'> Campo vacío</span>";
                            } else {
                                echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
                            }
                        }
                        ?>
                    </p>
                    <p>
                        <label for="usuario">Usuario</label></br>
                        <input type="text" name="usuario" id="usuario" maxlength="30" value="<?php echo $usuario; ?>">
                        <?php
                        if (isset($_POST["btnConEditar"]) && $error_usuario) {

                            if ($_POST["usuario"] == "") {
                                echo "<span class='error'> Campo vacío</span>";
                            } elseif (strlen($_POST["usuario"]) > 20) {
                                echo "<span class='error'> Has tecleado más de 20 caracteres</span>";
                            } else {
                                echo "<span class='error'> Usuario repetido</span>";
                            }
                        }
                        ?>
                    </p>
                    <p>
                        <label for="clave">Contraseña</label></br>
                        <input type="password" name="clave" id="clave" maxlength="15"><!--NO pongo value poque no se guarda la contraseña si hay error, la tiene que escribir otra vez-->
                        <?php
                        if (isset($_POST["btnConEditar"]) && $error_clave) {
                            if ($_POST["clave"] == "") {
                                echo "<span class='error'> Campo vacío</span>";
                            } else {
                                echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
                            }
                        }
                        ?>
                    </p>
                    <p>
                        <label for="dni">DNI</label></br>
                        <input type="text" name="dni" id="dni" maxlength="9" value="<?php echo $dni; ?>" />
                        <?php
                        if (isset($_POST["btnContEditar"]) && $error_dni) {
                            if ($_POST["dni"] == "") {
                                echo "<span class='error'> Campo vacío </span>";
                            } elseif (!dni_bien_escrito($dni_may)) {
                                echo "<span class='error'> DNI no está bien escrito </span>";
                            } elseif (!dni_valido($dni_may)) {
                                echo "<span class='error'> DNI no válido </span>";
                            } else {
                                echo "<span class='error'> DNI repetido </span>";
                            }
                        }
                        ?>
                    </p>
                    <p>
                        <label for="sexo">Sexo</label></br>
                        <input type="radio" <?php if ($sexo == "hombre") {
                                                echo 'checked';
                                            }
                                            ?> name="sexo" value="hombre">
                        <label for="hombre">Hombre</label></br>
                        <input type="radio" <?php if ($sexo == "mujer") {
                                                echo 'checked';
                                            }
                                            ?> name="sexo" value="mujer">
                        <label for="mujer">mujer</label>

                    </p>
                    <p>
                        <label for="archivo">Seleccione un archivo imagen(Max 500KB)</label>
                        <input type="file" name="archivo" id="archivo" accept="image/*">
                        <?php
                        // le damos al boton y hay un error....¿pero cual?
                        if (isset($_POST["btnContEditar"]) && $error_archivo) {
                            // si hay un error al subir al servidor (vemos los errores)
                            if ($_FILES["archivo"]["name"] != "") {
                                // si no se almacena correctamente al servidor
                                if ($_FILES["archivo"]["error"]) {
                                    echo "<span class='error'> No se ha podido subir el archivo al servidor</span>";
                                } elseif (!getimagesize($_FILES["archivo"]["tmp_name"])) {

                                    echo "<span class='error'>El archivo seleccionado no es una fotografia</span>";
                                } elseif (!tiene_extension($_FILES["archivo"]["name"])) {
                                    echo "<span class='error'> El archivo que has selecciondo no tienenextension </span>";
                                } else {
                                    // si te pasas de tamanio
                                    echo "<span class='error'> El archivo seleccionado supera los 500 MAX</span>";
                                }
                            }
                        }
                        ?>
                    </p>

                    <p>
                    <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
                        <input type="hidden" name="foto_bd" value="<?php echo $foto ?>">
                        <button type="submit" name="btnConEditar">Continuar</button>
                        <button type="submit" name="atras">Atrás</button>
                    </p>
                </form>
            </div>
            <div>
                <p class="centrado">
                    <img class="foto_detalle2" src="Img/<?php echo $foto;?>" title="Foto de Perfil" alt="Foto de Perfil"><br>
                    <?php
                    if(isset($_POST["btnBorrarFoto"])){
                        ////
                        echo"¿Estas seguro que quieres borrar foto?<br><button name='btnContBorrarFoto' >si</button><button name='btnNoBorrarFoto'NO</button>";
                    }
                    elseif ($foto != "no_imagen.jpg")
                        echo "<button type='submit' name='btnBorrarFoto'  value=" . '<?php echo $id_usuario ?>' . "Borrar Foto</button>";
                    ?>

                </p>
            </div>
    <?php
        }
    }
    // muestro la consulta generaal de la tabla INICIO
    require "vistas/vista_tabla.php";
    ?>
</body>

</html>