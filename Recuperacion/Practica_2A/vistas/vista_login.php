<?php


if (isset($_POST["btnEntrar"])) {
    //errores del formulario
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form = $error_clave || $error_usuario;

    if (!$error_form) {
        try{
            $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); 
        }
        catch(PDOException $e){
            session_destroy();
            die(error_page("Práctica Rec 2","<h1>Práctica Rec 2</h1><p>Imposible conectar a la BD. Error:".$e->getMessage()."</p>"));
        }

        try {
            $consulta = "select * from usuarios where usuario=? and clave=?";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute([$_POST["usuario"], md5($_POST["clave"])]);
        } catch (PDOException $e) { // si falla la conexion
            $sentencia = null;
            $conexion = null;
            session_destroy();
            die(error_page("Practica rec 2", "<h1>Imposible de cinectar con la base de datos error: " . $e->getMessage() . " </1h>"));;
        }

        if ($sentencia->rowCount() > 0) {
            $sentencia = null;
            $conexion = null;
            $_SESSION["usuario"] = $_POST["usuario"]; //genero la variable de sesion
            $_SESSION["clave"] = md5($_POST["clave"]);
            $_SESSION["ultima_accion"] = time();;// guardo la ultima hora de la sesión para la seguridad
            header("Location:index.php"); // salto a la pagina de index
            exit;
          
        } else {
            $sentencia = null;
            $conexion = null;
            echo "<p>No hay usuario con esas credenciales en la base de datos</p>";
        }
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
        .mensaje{
            color:blue,
        }
    </style>
</head>

<body>
    <h1>Práctica Rec 2</h1>
    <form action="index.php" method="post">

        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php if (isset($_POST["btnEntrar"])) echo $_POST["usuario"] ?>">
            <?php
            if (isset($_POST["btnEntrar"]) && $error_usuario) {

                echo "<span class='error'> Este campo es obligatorio</span>";
            }
            ?>
        </p>

        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave " name="clave">
            <?php
            if (isset($_POST["btnEntrar"]) && $error_clave) {

                echo "<span class='error'> Este campo es obligatorio</span>";
            }
            ?>
        </p>

        <p>
            <button type="submit" name="btnEntrar" value="entrar">Entrar</button>
            <button type="submit" name="btnRegistro" value="registro">Registrarse</button>
        </p>

    </form>

    <?php
        if(isset($_SESSION["seguridad"]))
        {

            echo"<p class='mensage'>".$_SESSION["seguridad"]."</p>";
            session_destroy();

        }
    ?>
</body>

</html>