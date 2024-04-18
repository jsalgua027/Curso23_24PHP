<?php
if(isset($_POST["btnConEditar"])){
    //cojo la id usaurio
    $id_usuario=$_POST["btnConEditar"]; //del boton
    $usuario =$_POST["usuario"];// de los values introducidos 
    $nombre =$_POST["nombre"];
    $dni =$_POST["dni"];
    $foto =$_POST["foto_bd"];
    $sexo =$_POST["sexo"];
    if(isset($_POST["subscripcion"]))
    {
        $subscripcion=1;
    }
    else
    {
        $subscripcion=0;
    }

    // compruebo errores
    $error_usuario = $_POST["usuario"] == "";
    if (!$error_usuario) {
       
        }
        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"],"id_usuario", $id_usuario);

        if (is_string($error_usuario)) {
            $conexion = null;
            die(error_page("Práctica 2º Rec", "<h1>Práctica 2º Rec</h1><p>No se ha podido realizar la consulta: " . $error_usuario . "</p>"));
        }
    
    $error_nombre = $_POST["nombre"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
    if (!$error_dni) {
        if (!isset($conexion)) {
            try {
                $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            } catch (PDOException $e) {
                session_destroy();
                die(error_page("Práctica Rec 2", "<h1>Práctica Rec 2</h1><p>Imposible conectar a la BD. Error:" . $e->getMessage() . "</p>"));
            }
        }
        $error_dni = repetido($conexion, "usuarios", "dni", strtoupper($_POST["dni"]));

        if (is_string($error_dni)) {
            $conexion = null;
            die(error_page("Práctica 2º Rec", "<h1>Práctica 2º Rec</h1><p>No se ha podido realizar la consulta: " . $error_dni . "</p>"));
        }
    }
    $error_sexo = !isset($_POST["sexo"]);

    $array_nombre = explode(".", $_FILES["archivo"]["name"]); // meto el nombre en una variable tipo array
    $error_archivo = $_FILES["archivo"]["name"] != "" && ($_FILES["archivo"]["error"] || !$array_nombre || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024);/* foto obligatoria */
    $error_form = $error_usuario || $error_nombre || $error_clave || $error_dni || $error_sexo || $error_archivo;

    if(!$error_form)
    {

        try {
            if($_POST["clave"]== "")
            {
                $consulta="update usuarios set  nombre=?, usuario=?, dni=?, sexo=? ,subscripcion=? where id_usuario=? ";
                $datos_edit=[$nombre,$usuario,strtoupper($dni),$sexo,$subscripcion,$id_usuario];
            }
              else {
                $consulta="update usuarios set  nombre=?, usuario=?, clave=?,  dni=?, sexo=? ,subscripcion=? where id_usuario=? ";
                $datos_edit=[$nombre,$usuario,md5($_POST["clve"]),strtoupper($dni),$sexo,$subscripcion,$id_usuario];
            }
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute($datos_edit);
            $sentencia = null;

        } catch (PDOException $e) { // si falla la conexion
            $sentencia_detalle = null;
            $conexion = null;
            die("<p>No hacer la consulta por fallo de la conexión: " . $e->getMessage() . "</p></body></html>");
        }

        $mensaje="Usuario editado con exito";
        if($foto["foto"]["name"]!="")
        {
           // generar nombre de nueva foto
           // muevo la foto a images
           //si nombre nueva foto es distinta a $foto(bd) y si la $foto_bd es distinra "no_image.jpg" entonces borro $foto de images y actualzio  base de datos  
        }

        $conexion=null;
        $_SESSION["mensaje_accion"]=$mensaje;
        header("Location:index.php");
        exit;

    }

}



if (isset($_POST["btnConBorrar"])) {

    try {


        $consulta_borrar = "DELETE FROM usuarios WHERE id_usuario=?";
        $sentencia_borrar = $conexion->prepare($consulta_borrar);
        $sentencia_borrar->execute([$_POST["btnConBorrar"]]);
        if ($_POST["foto"] != FOTO_DEFECTO) {

            unlink("images/" . $_POST["foto"]);
        }


        $_SESSION["mensaje"] = "Usuario eliminado correctamente.";
        $sentencia_borrar = null;
        $conexion = null;
        header("Location:index.php"); // salto para borrar los $post
        exit;
    } catch (PDOException $e) {
        // Manejo de errores
        $sentencia = null;
        $conexion = null;
        die("<p>No se pudo completar la operación: " . $e->getMessage() . "</p>");
    }
}
if (isset($_POST["btnEditar"])) {
    $id_usuario = $_POST["btnEditar"];
    try {
        $consulta = "select * from usuarios where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id_usuario]);
        // control de errores
        if ($sentencia->rowCount() > 0) {
            $detalle_usu = $sentencia->fetch(PDO::FETCH_ASSOC);
            $usuario = $detalle_usu["usuario"];
            $nombre = $detalle_usu["nombre"];
            $dni = $detalle_usu["dni"];
            $foto = $detalle_usu["foto"];
            $sexo = $detalle_usu["sexo"];
            $subscripcion = $detalle_usu["subscripcion"];
        } else {
            $detalle_usu = false; // controlo que no se haga cambios en varios navegadores
        }
    } catch (PDOException $e) { // si falla la conexion
        $sentencia_detalle = null;
        $conexion = null;
        die("<p>No hacer la consulta por fallo de la conexión: " . $e->getMessage() . "</p></body></html>");
    }
}


if (isset($_POST["btnDetalle"])) {

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        session_destroy();
        die(error_page("Práctica Rec 2", "<h1>Práctica Rec 2</h1><p>Imposible conectar a la BD. Error:" . $e->getMessage() . "</p>"));
    }

    try {
        $consulta_detalle = "select * from usuarios where id_usuario=?";
        $sentencia_detalle = $conexion->prepare($consulta_detalle);
        $sentencia_detalle->execute([$_POST["btnDetalle"]]);
        // control de errores
        if ($sentencia_detalle->rowCount() > 0) {
            $usuario_detalle = $sentencia_detalle->fetch(PDO::FETCH_ASSOC);
        } else {
            die("<p>No hay ususario con esa ID </p></body></html>");
        }
        $sentencia_detalle = null;
        $conexion = null;
    } catch (PDOException $e) { // si falla la conexion
        $sentencia_detalle = null;
        $conexion = null;
        die("<p>No hacer la consulta por fallo de la conexión: " . $e->getMessage() . "</p></body></html>");
    }
}


//aqui hago la consulta a la base de datos para mostralos si al usuario es admin
// genero la conexion
try {
    $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    session_destroy();
    die(error_page("Práctica Rec 2", "<h1>Práctica Rec 2</h1><p>Imposible conectar a la BD. Error:" . $e->getMessage() . "</p>"));
}

try {
    $consulta = "select * from usuarios where tipo<>'admin'"; // que sean distintos a admin
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute();
} catch (PDOException $e) { // si falla la conexion
    $sentencia = null;
    $conexion = null;
    die("<p>No hacer la consulta por fallo de la conexión: " . $e->getMessage() . "</p></body></html>");
}

$todos_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td,
        th {
            border: 1px solid black;



        }

        table {
            border-collapse: collapse
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

        .mensaje {
            color: blue;
            font-size: 1.5em
        }

        .txt_centrado {
            text-align: center
        }

        .no_bordes {
            border: none
        }

        .centrado {
            width: 80%;
            margin: 0 auto
        }

        .grande {
            font-size: 1.5em
        }

        img {
            width: 100px;
        }
        .imag_editar{
            width: 100px;
        }
        
    </style>
</head>

<body>
    <h1>USUARIO ADMIN</h1>
    <h2>Práctica Rec2</h2>
    <div>Bienvenido <strong><?php echo $_SESSION["usuario"]; ?></strong> -
        <form class='enlinea' action="index.php" method="post">
            <button class='enlace' type="submit" name="btnSalir">Salir</button>
        </form>
    </div>
    <?php
    /**************************************************************NUEVO USUARIO*******************************************/
    if (isset($_POST["btnNuevoUser"]) || isset($_POST["btnAgregar"]) || isset($_POST["btnBorrarDatos"])) {
        if (isset($_POST["btnBorrarDatos"])) {
            unset($_POST);
        }
        if (isset($_POST["btnAgregar"])) {
            $error_usuario = $_POST["usuario"] == "";
            if (!$error_usuario) {
                try {
                    $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                } catch (PDOException $e) {
                    session_destroy();
                    die(error_page("Práctica Rec 2", "<h1>Práctica Rec 2</h1><p>Imposible conectar a la BD. Error:" . $e->getMessage() . "</p>"));
                }
                $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"]);

                if (is_string($error_usuario)) {
                    $conexion = null;
                    die(error_page("Práctica 2º Rec", "<h1>Práctica 2º Rec</h1><p>No se ha podido realizar la consulta: " . $error_usuario . "</p>"));
                }
            }
            $error_nombre = $_POST["nombre"] == "";
            $error_clave = $_POST["clave"] == "";
            $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
            if (!$error_dni) {
                if (!isset($conexion)) {
                    try {
                        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
                    } catch (PDOException $e) {
                        session_destroy();
                        die(error_page("Práctica Rec 2", "<h1>Práctica Rec 2</h1><p>Imposible conectar a la BD. Error:" . $e->getMessage() . "</p>"));
                    }
                }
                $error_dni = repetido($conexion, "usuarios", "dni", strtoupper($_POST["dni"]));

                if (is_string($error_dni)) {
                    $conexion = null;
                    die(error_page("Práctica 2º Rec", "<h1>Práctica 2º Rec</h1><p>No se ha podido realizar la consulta: " . $error_dni . "</p>"));
                }
            }
            $error_sexo = !isset($_POST["sexo"]);

            $array_nombre = explode(".", $_FILES["archivo"]["name"]); // meto el nombre en una variable tipo array
            $error_archivo = $_FILES["archivo"]["name"] != "" && ($_FILES["archivo"]["error"] || !$array_nombre || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024);/* foto obligatoria */
            $error_form = $error_usuario || $error_nombre || $error_clave || $error_dni || $error_sexo || $error_archivo;

            if (!$error_form) {
                // hago la insercion de dato
                try {
                    if (isset($_POST["subscripcion"])) // si esta cheked le inidco el valor 
                    {
                        $subs = 1;
                    } else {
                        $subs = 0;
                    }
                    $consulta = "insert into usuarios (usuario,nombre,clave,dni,sexo,subscripcion) values(?,?,?,?,?,?)";
                    $clave_encriptada = md5($_POST["clave"]);
                    $sentencia = $conexion->prepare($consulta);
                    $sentencia->execute([$_POST["usuario"], $_POST["nombre"], $clave_encriptada, strtoupper($_POST["dni"]), $_POST["sexo"], $subs]);
                    $sentencia = null;
                } catch (PDOException $e) {
                    $setencia = null;
                    $conexion = null;
                    session_destroy();
                    die(error_page("Práctica 2º REC", "<h1>Práctica 2º REC</h1><p>No se ha podido hacer la insercción: " . $e->getMessage() . "</p>"));
                }
                $mensaje = "se ha registrado con exito";

                if ($_FILES["archivo"]["name"] != "") {
                    // me quedo con la extension
                    $ultimo_id = $conexion->lastInsertId(); // me quedo con la ultima id para ponerla como nombre unico
                    $array_ext = explode(".", $_FILES["archivo"]["name"]);

                    $ext = "." . end($array_ext); // obtengo la extension
                    $nombre_nuevo = "img_" . $ultimo_id . $ext; //concateno el nombre

                    @$var = move_uploaded_file($_FILES["archivo"]["tmp_name"], "images/" . $nombre_nuevo);
                    if ($var) {
                        try {
                            $consulta = "UPDATE usuarios SET foto = ? WHERE id_usuario = ?";
                            $sentencia = $conexion->prepare($consulta);
                            $sentencia->execute([$nombre_nuevo, $ultimo_id]);
                            $sentencia = null;
                        } catch (PDOException $e) {
                            unlink("images/" . $nombre_nuevo); // si falla
                            $sentencia = null;
                            $conexion = null;
                            die(error_page("Práctica 2º REC", "<h1>Práctica 2º REC</h1><p>No se ha podido subir la foto: " . $e->getMessage() . "</p>"));
                        }
                    } else {
                        $mensaje = "Usuario registrado con exito pero con la imagen por defecto ya que no se ha podido mover la imagen";
                    }
                }
                header("location:index.php");
                exit;
            }

            if (isset($conexion)) {
                $conexion = null;
            }
        }
    ?>
        <h3>Insertando Nuevo Usuario</h3>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
                <?php
                if (isset($_POST["btnAgregar"]) && $error_usuario) {
                    if ($_POST["usuario"] == "") {
                        echo "<span class='error'>*Campo obligatorio*</span>";
                    } else {
                        echo "<span class='error'>*El usuario esta repetido*</span>";
                    }
                }
                ?>
            </p>
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
                <?php
                if (isset($_POST["btnAgregar"]) && $error_nombre) {
                    echo "<span class='error'>*Campo obligatorio*</span>";
                }
                ?>
            </p>
            <p>
                <label for="clave">Contraseña:</label>
                <input type="password" id="clave" name="clave">
                <?php
                if (isset($_POST["btnAgregar"]) && $error_clave) {
                    echo "<span class='error'>*Campo Obligatorio*</span>";
                }
                ?>
            </p>
            <p>
                <label for="dni">DNI:</label>
                <input type="text" name="dni" id="dni" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
                <?php
                if (isset($_POST["btnAgregar"]) && $error_dni) {
                    if ($_POST["dni"] == "")
                        echo "<span class='error'>Campo vacio </span>";
                    elseif (!dni_bien_escrito((strtoupper($_POST["dni"])))) {
                        echo "<span class='error'>El dni no esta bien escrito </span>";
                    } elseif (!dni_valido(strtoupper($_POST["dni"]))) {

                        echo "<span class='error'>El dni no es valido </span>";
                    } else {
                        echo "<span class='error'>El dni esta repetido </span>";
                    }
                }


                ?>
            </p>
            <p>
                <label for="sexo">Sexo:</label><br />
                <input type="radio" id="hombre" name="sexo" value="hombre" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") echo "checked" ?>>
                <label for="hombre">Hombre:</label><br />
                <input type="radio" id="mujer" name="sexo" value="mujer" <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") echo "checked" ?>>
                <label for="mujer">Mujer:</label>
                <?php
                if (isset($_POST["btnAgregar"]) && $error_sexo) {
                    echo "<span class='error'>*Campo obligatorio*</span>";
                }
                ?>
            </p>
            <p>

                Incluir mi foto (Max 500KB)
                <input type="file" id="archivo" name="archivo">

                <?php
                if (isset($_POST["btnAgregar"]) && $error_archivo) {


                    if ($_FILES["archivo"]["error"]) {
                        echo " <span class='error'> No se ha podido subir el archivo al servidor</span>";
                    } elseif (!getimagesize($_FILES["archivo"]["tmp_name"])) {

                        echo " <span class='error'>El archivo subido debe de ser una imagen </span>";
                    } elseif (!explode(".", $_FILES["archivo"]["name"])) {
                        echo " <span class='error'> El archivo tiene que tener extension</span>";
                    } else {
                        echo " <span class='error'> El archivo seleccionado supera los 500 KB MAX</span>";
                    }
                }


                ?>
            </p>
            <p>
                <input type="checkbox" id="subscripcion" name="subscripcion">
                Subcribirme al boletín de novedades
            </p>
            <p>
                <button type="submit" name="btnAgregar" value="guardar">Guardar Cambios</button>
                <button type="submit" name="btnBorrarDatos" value="borrar">Borrar los datos introducidos</button>
            </p>
        </form>


    <?php
    }

    ?>

    <?php
    if (isset($_POST["btnBorrarUser"])) {

        echo "<div class='centrar'>";
        echo "<form method='post' action='index.php'>";
        echo "<input type='hidden' name='foto' value='" . $_POST["foto"] . "'/>";
        echo "<h2>borrado el usuaio con id: " . $_POST["btnBorrarUser"] . "</h2>";
        echo "<p>¿ Estás seguro?</p>";
        echo "<p><button type='submit'>No</button><button type='submit' name='btnConBorrar'value='" . $_POST["btnBorrarUser"] . "'>Si</button></p>";
        echo "</form>";
        echo "</div>";
    }

//*********************************************************EDITAR******************************************************************************************/

    if (isset($_POST["btnEditar"])||isset($_POST["btnConEditar"])||isset($_POST["btnBorrarEditar"])) {
        echo "<h2>Detalles del usuario  a Editar con id: " . $id_usuario . "</h2>";
        if (!isset($usuario)) {
            // no he obtenido usuario
            echo "<p>El usuario no se encuntra en la base de daros</p>";
        } else {

            //tengo pendiente una gestio de datos con el id usuario dependiendo del boton

    ?>

            <form action="index.php" method="post" enctype="multipart/form-data">
                <p>
                    <label for="usuario">Usuario:</label>
                    <input type="text" id="usuario" name="usuario" value="<?php echo $usuario;?>">
                    <?php
                    if (isset($_POST["btnConEditar"]) && $error_usuario) {
                        if ($_POST["usuario"] == "") {
                            echo "<span class='error'>*Campo obligatorio*</span>";
                        } else {
                            echo "<span class='error'>*El usuario esta repetido*</span>";
                        }
                    }
                    ?>
                </p>
                <p>
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" value="<?php echo $nombre;?>">
                    <?php
                    if (isset($_POST["btnConEditar"]) && $error_nombre) {
                        echo "<span class='error'>*Campo obligatorio*</span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="clave">Contraseña:</label>
                    <input type="password" id="clave" name="clave" placeholder="Teclee nueva contraseña">
                    <?php
                    if (isset($_POST["btnConEditar"]) && $error_clave) {
                        echo "<span class='error'>*Campo Obligatorio*</span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="dni">DNI:</label>
                    <input type="text" name="dni" id="dni" value="<?php echo $dni;?>">
                    <?php
                    if (isset($_POST["btnConEditar"]) && $error_dni) {
                        if ($_POST["dni"] == "")
                            echo "<span class='error'>Campo vacio </span>";
                        elseif (!dni_bien_escrito((strtoupper($_POST["dni"])))) {
                            echo "<span class='error'>El dni no esta bien escrito </span>";
                        } elseif (!dni_valido(strtoupper($_POST["dni"]))) {

                            echo "<span class='error'>El dni no es valido </span>";
                        } else {
                            echo "<span class='error'>El dni esta repetido </span>";
                        }
                    }


                    ?>
                </p>
                <p>
                    <label for="sexo">Sexo:</label><br />
                    <input type="radio" id="hombre" name="sexo" value="hombre" <?php if ($sexo=="hombre") echo "checked" ?>>
                    <label for="hombre">Hombre:</label><br />
                    <input type="radio" id="mujer" name="sexo" value="mujer" <?php if ($sexo== "mujer") echo "checked" ?>>
                    <label for="mujer">Mujer:</label>
                    <?php
                    if (isset($_POST["btnConEditar"]) && $error_sexo) {
                        echo "<span class='error'>*Campo obligatorio*</span>";
                    }
                    ?>
                </p>
                <p>

                    Incluir mi foto (Max 500KB)
                    <input type="file" id="archivo" name="archivo">

                    <?php
                    if (isset($_POST["btnConEditar"]) && $error_archivo) {


                        if ($_FILES["archivo"]["error"]) {
                            echo " <span class='error'> No se ha podido subir el archivo al servidor</span>";
                        } elseif (!getimagesize($_FILES["archivo"]["tmp_name"])) {

                            echo " <span class='error'>El archivo subido debe de ser una imagen </span>";
                        } elseif (!explode(".", $_FILES["archivo"]["name"])) {
                            echo " <span class='error'> El archivo tiene que tener extension</span>";
                        } else {
                            echo " <span class='error'> El archivo seleccionado supera los 500 KB MAX</span>";
                        }
                    }


                    ?>
                </p>
                <p>
                    <input type="checkbox" id="subscripcion" name="subscripcion" value='<?php if($subscripcion) echo "checked";?>'>
                    Subcribirme al boletín de novedades
                </p>
                <p>
                    
                    <input type="hidden" name="foto_bd" value='<?php echo $foto?>'>
                    <button type="submit" name="btnConEditar" value="<?php echo $id_usuario?>">Guardar Cambios</button>
                    <button type="submit" name="btnBorrarEditar" value="<?php echo $id_usuario?>">Borrar los datos introducidos</button>
                </p>

                <div>
                    <img class='imag_editar' src='images/<?php echo $foto?>' title='foto' alt='foto'>
                </div>
            </form>






    <?php
        }
    }

    if (isset($_POST["btnDetalle"])) {
        echo "<h2>Detalle del Usuario con Id:  " . $usuario_detalle["id_usuario"] . "</h2>";
        if ($usuario_detalle) {
            echo "<p><strong>Nombre: </strong>" . $usuario_detalle["nombre"] . "</p>";
            echo "<p><strong>Usuario: </strong>" . $usuario_detalle["nombre"] . "</p>";
            echo "<p><strong>Dni: </strong>" . $usuario_detalle["dni"] . "</p>";
            echo "<p><strong>Sexo: </strong>" . $usuario_detalle["sexo"] . "</p>";
            echo "<p><strong>Subscripcion: </strong>" . $usuario_detalle["subscripcion"] . "</p>";
            echo "<img src='images/" . $usuario_detalle["foto"] . "'name='foto'title='fotoUser' alt='foto'>";
        } else {
            echo "<p>El usaurio seleccionado ya no se encuentra en la base de datos</p>";
        }
    }



    echo "<h2>Listado de los usuarios (no admin)</h2>";
    echo "<table id='tb_principal' class='txt_centrado centrado'>";
    echo "<tr><th>#</th><th>Foto</th><th>Nombre</th><th><form action='index.php' method='post'><button class='enlace' type='submit' name='btnNuevoUser'>Usuario+</button></form></th></tr>";
    foreach ($todos_usuarios as $tupla) {
        echo "<tr>";
        echo "<td>" . $tupla["id_usuario"] . "</td>";
        echo "<td><img src='images/" . $tupla["foto"] . "'name='foto'title='fotoUser' alt='foto'></td>";
        echo "<td><form action='index.php' method='post'><button type='submit'class='enlace' name='btnDetalle' value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</button></form></td>";
        echo "<td><form action='index.php' method='post'><input type='hidden' name='foto' value='" . $tupla["foto"] . "'/><button class='enlace' name='btnBorrarUser' value='" . $tupla["id_usuario"] . "'>Borrar</button> - <button class='enlace' name='btnEditar' value='" . $tupla["id_usuario"] . "'>Editar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";

    if (isset($_SESSION["mensaje"])) {
        echo "<p class='mensaje'>" . $_SESSION["mensaje"] . "</p>";
        unset($_SESSION["mensaje"]);
    }

    ?>


</body>

</html>