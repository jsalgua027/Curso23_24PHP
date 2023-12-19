<?php
require("src/ctes_func.php");
if (isset($_POST["btnVolver"]))
    header("Location:index.php");
exit;

//control de errores
if (isset($_POST["btnConRegistro"])) {

    $error_usuario = $_POST["usuario"] == "" || strlen($_POST["usuario"]) > 15;
    if (!$error_usuario) {
        try {
            $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
            mysqli_set_charset($conexion, "utf8");
        } catch (Exception $e) {
            session_destroy();
            die(error_page("Video Club", "<h1>Video Club</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }

        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"], "id_usuario", $_POST["id_usuario"]);

        if (is_string($error_usuario)) {
            mysqli_close($conexion);

            die(error_page("Video Club8", "<h1>Video Club</h1><p>No se ha podido realizar la consulta: " . $error_usuario . "</p>"));
        }
    }
    $error_clave = strlen($_POST["clave"]) > 15 || $_POST["clave"] == "" || $_POST["clave"] == $_POST["clave2"];
    $dni_may = strtoupper($_POST["dni"]);
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito($dni_may) || !dni_valido($dni_may);
    if (!$error_dni) {
        if (!isset($conexion)) {
            try {
                $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
                mysqli_set_charset($conexion, "utf8");
            } catch (Exception $e) {

                die(error_page("Video Club8", "<h1>Video Club</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
            }
        }
        $error_dni = repetido($conexion, "usuarios", "dni", $dni_may, $_POST["dni"]);

        if (is_string($error_dni)) {
            mysqli_close($conexion);;
            die(error_page("Video Club8", "<h1>Video Club</h1>No ha podido realizarse la consulta: " . $error_dni . "</p>"));
        }
    }

    $error_email = strlen($_POST["email"]) > 15 || $_POST["clave"] == "" || !filter_var($correo, FILTER_VALIDATE_EMAIL);
    $error_dni = repetido($conexion, "usuarios", "email", $_POST["email"]);

    if (is_string($error_email)) {
        mysqli_close($conexion);;
        die(error_page("Video Club8", "<h1>Video Club</h1>No ha podido realizarse la consulta: " . $error_dni . "</p>"));
    }

    $error_telefono = $_POST["telefono"] == "" || !is_numeric($_POST["telefono"]);

    $error_form = $error_usuario || $error_clave || $error_dni || $error_email || $error_telefono;
    if (!$error_form) {
        try {
            $consulta = "insert into (DNI, usuario, clave, telefono, email) values('" . $dni_may . "','" . $_POST["usuario"] . "'," . $_POST["clave"] . "'," . $_POST["telefono"] . "'," . $_POST["email"] . "' )";
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Video Club8", "<h1>Video Club</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
        }
        session_name("Examen3_17_18");
        session_start();
        $_SESSION["usuario"] = $_POST["usuario"];
        $_SESSION["clave"] = md5($_POST["clave"]);
        $_SESSION["ultima_accion"] = time(); //creo la variable del tiempo de la sesion
        mysqli_close($conexion);
        header("Location:index.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
</head>

<body>
    <h1>Video Club</h1>

    <form action="registro_usuario.php" method="post">
        <p>
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" maxlength="15" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>" />
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_usuario) {
                if ($_POST["usuario"] == "")
                    echo "<span class='error'> Campo vacío </span>";
                elseif (strlen($_POST["usuario"]) > 15)
                    echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
                else
                    echo "<span class='error'> Usuario repetido</span>";
            }

            ?>
        </p>
        <p>
            <label for="clave">Contraseña</label>
            <input type="password" name="clave" id="clave" maxlength="15" />
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_clave) {
                if ($_POST["clave"] == "")
                    echo "<span class='error'> Campo vacío </span>";
                elseif (strlen($_POST["clave"]) > 15)

                    echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
                else
                    echo "<span class='error'> erroe</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave2"> Repita la Contraseña</label>
            <input type="password" name="clave2" id="clave2" maxlength="15" />

            < <p>
                <label for="dni">DNI:</label>
                <input type="text" placeholder="DNI: 11223344Z" maxlength="9" name="dni" id="dni" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"]; ?>" />
                <?php
                if (isset($_POST["btnContRegistro"]) && $error_dni) {
                    if ($_POST["dni"] == "")
                        echo "<span class='error'> Campo vacío </span>";
                    elseif (!dni_bien_escrito($dni_may))
                        echo "<span class='error'> DNI no está bien escrito </span>";
                    elseif (!dni_valido($dni_may))
                        echo "<span class='error'> DNI no válido </span>";
                    else
                        echo "<span class='error'> DNI repetido </span>";
                }

                ?>
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"]; ?>" />
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_email) {
                if ($_POST["email"] == "")
                    echo "<span class='error'> Campo vacío </span>";
                elseif (strlen($_POST["email"]) > 15)
                    echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
                elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL))
                    echo "<span class='error'> Email es incorrecto</span>";

                else
                    echo "<span class='error'> Usuario repetido</span>";
            }

            ?>
        </p>
        <p>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="<?php if (isset($_POST["telefono"])) echo $_POST["telefono"]; ?>" />
            <?php
            if (isset($_POST["btnContRegistro"]) && $error_telefono) {
                if ($_POST["telefono"] == "")
                    echo "<span class='error'> Campo vacío </span>";
                elseif (is_numeric($_POST["telefono"]))
                    echo "<span class='error'> No has tecleado un numero</span>";


                else
                    echo "<span class='error'>Has tecleado un numero de mas de 9 digitos</span>";
            }

            ?>
        </p>

        <p>
            <button type="submit" name="btnVolver">Volver</button>
            <button type="submit" name="btnConRegistro">Continuar</button>
        </p>



    </form>

</body>

</html>
<?php

?>