<?php

if (isset($_POST["btnEntrar"])) {
    //errores del formulario
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form = $error_clave || $error_usuario;

    if (!$error_form) {
          
        try {
            $consulta = "select * from usuarios where usuario=? and clave=?";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute([ $_POST["usuario"], md5($_POST["clave"])]);
        } catch (PDOException $e) { // si falla la conexion
            $sentencia = null;
            $conexion = null;
            die("<p>No hacer la consulta por fallo de la conexión: " . $e->getMessage() . "</p></body></html>");
        }

        if($sentencia->rowCount()>0){
            $_SESSION["usuario"]=$_POST["usuario"]; //genero la variable de sesion
            $_SESSION["clave"]=$_POST["clave"];

            $datos_usuario_logeado=$sentencia->fetch(PDO::FETCH_ASSOC);

          echo"<p> la variable de sesion es= ".$_SESSION["usuario"]."</p>";
          echo"<p>el tipo de usuario es: ".$datos_usuario_logeado["tipo"]."</p>";

          header("Location:index.php");
          exit;

        }else{
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
    <title>Login</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST["btnRegistro"])) {
        require("./vistas/vista_registro.php");
    } else {
    ?>
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
    }
    ?>

</body>

</html>