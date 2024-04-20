<?php
if (isset($_POST["btnBorrarDatos"])) {
    unset($_POST);
}


//control de errores del registro de ususario normal
if (isset($_POST["btnNuevoRegistro"])) {
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
            session_destroy();
            die(error_page("Práctica 2º Rec", "<h1>Práctica 2º Rec</h1><p>No se ha podido realizar la consulta: " . $error_usuario . "</p>"));
        }
    }
    $error_nombre = $_POST["nombre"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
    if (!$error_dni) {
        if (!isset($conexion)) {// comprobamos si hay conexión por si se ha usado repetido() que necesita coneexión 
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
            session_destroy();
            die(error_page("Práctica 2º Rec", "<h1>Práctica 2º Rec</h1><p>No se ha podido realizar la consulta: " . $error_dni . "</p>"));
        }
    }
    $error_sexo = !isset($_POST["sexo"]);

    $array_nombre = explode(".", $_FILES["archivo"]["name"]); // meto el nombre en una variable tipo array
    $error_archivo = $_FILES["archivo"]["name"] != "" && ($_FILES["archivo"]["error"] || !$array_nombre || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024);/* foto obligatoria */
    $error_form = $error_usuario || $error_nombre || $error_clave || $error_dni || $error_sexo || $error_archivo;

    if (!$error_form) {
        // hago la insercción del usuario
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
            $setencia=null;
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 2º REC", "<h1>Práctica 2º REC</h1><p>No se ha podido hacer la insercción: " . $e->getMessage() . "</p>"));
        }
        $mensaje = "se ha registrado con exito";

        if ($_FILES["archivo"]["name"] != "") {
            // me quedo con la extension
            $ultimo_id = $conexion->lastInsertId(); // me quedo con la ultima id para ponerla como nombre unico (solo funciona si la base de datos es auto incremente de ese campo)
            $array_ext = explode(".", $_FILES["archivo"]["name"]);

            $ext = "." . end($array_ext); // obtengo la extension
            $nombre_nuevo = "img_" . $ultimo_id . $ext; //concateno el nombre

         
            if ($var) {
                try {
                    $consulta = "UPDATE usuarios SET foto = ? WHERE id_usuario = ?";
                    $sentencia = $conexion->prepare($consulta);
                    $sentencia->execute([$nombre_nuevo, $ultimo_id]);
                    $sentencia = null;
                } catch (PDOException $e) {
                    unlink("images/" . $nombre_nuevo); // si falla me borra la imagen 
                    $sentencia = null;
                    $conexion = null;
                    $mensaje = "Se ha registrado con exito pero con la imagen por defecto en el servidor"; // no morimos porque queremos que siga logueado por si quiere hacer cambios (si los pudiese hacer por la aplicacion que esra no se puede por el tipo de enunciado)
                }
            } else {
                $mensaje = "Nse ha registrado con exito pero con la imagen por defecto ya que no se ha podido mover la imagen";
            }
        }
        $conexion = null;
        $_SESSION["mensaje_registro"] = $mensaje;
        $_SESSION["usuario"] = $_POST["usuario"];
        $_SESSION["clave"] = md5($_POST["clave"]);
        $_SESSION["ultima_accion"] = time(); // una vez realizado el registro actualizo el tiempo
        header("Location:index.php");
        exit;
    }
    if (isset($conexion)) { // por sui hay errores y se ha quedado la conexión abierta
        $conexion = null;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: red
        }
        .mensaje {
            color: blue;
            font-size: 1.5em
        }
    </style>
</head>

<body>

    <h1>Práctica Rec 2</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
            <?php
            if (isset($_POST["btnNuevoRegistro"]) && $error_usuario) {
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
            if (isset($_POST["btnNuevoRegistro"]) && $error_nombre) {
                echo "<span class='error'>*Campo obligatorio*</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave">
            <?php
            if (isset($_POST["btnNuevoRegistro"]) && $error_clave) {
                echo "<span class='error'>*Campo Obligatorio*</span>";
            }
            ?>
        </p>
        <p>
            <label for="dni">DNI:</label>
            <input type="text" name="dni" id="dni" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
            <?php
            if (isset($_POST["btnNuevoRegistro"]) && $error_dni) {
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
            if (isset($_POST["btnNuevoRegistro"]) && $error_sexo) {
                echo "<span class='error'>*Campo obligatorio*</span>";
            }
            ?>
        </p>
        <p>

            Incluir mi foto (Max 500KB)
            <input type="file" id="archivo" name="archivo">

            <?php
            if (isset($_POST["btnNuevoRegistro"]) && $error_archivo) {


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
            <button type="submit" name="btnNuevoRegistro" value="guardar">Guardar Cambios</button>
            <button type="submit" name="btnBorrarDatos" value="borrar">Borrar los datos introducidos</button>
        </p>
    </form>
    <?php
    if(isset($_SESSION["mensaje_registro"]))
    {
        echo"<p class='mensaje'>".$_SESSION["mensaje_registro"]."</p>";

    }
    ?>
</body>

</html>