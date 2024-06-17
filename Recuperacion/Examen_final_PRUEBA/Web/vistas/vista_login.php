<?php
if(isset($_POST["btnLogin"]))
{
    $error_usuario=$_POST["usuario"]=="";
    $error_clave=$_POST["clave"]=="";
    $error_form=$error_usuario||$error_clave;
    if(!$error_form)
    {
        $datos_env["usuario"]=$_POST["usuario"];
        $datos_env["clave"]=md5($_POST["clave"]);

       $respuesta=consumir_servicios_REST(DIR_SERV.'/login',"GET",$datos_env);
       $json=json_decode($respuesta,true);
       
       if(!$json)
       {
        session_destroy();
        die(error_page("Examen Final PHP","<h1>Examen Final PHP</h1><p>Error consumiendo el servicio: API login</p>"));
       }
       if(isset($json["error"]))
       {
        session_destroy();
        die(error_page("Examen Final PHP","<h1>Examen Final PHP</h1><p>El mensaje error es: ".$json["error"]."</p>"));
       }
       if(isset($json["mensaje"]))
       {
        $error_usuario=true;
       }
       else
       {
        $_SESSION["usuario"]=$json["usuario"]["usuario"];
        $_SESSION["clave"]=$json["usuario"]["clave"];
        $_SESSION["tipo"]=$json["usuario"]["tipo"];
        $_SESSION["api_session"]=$json["api_session"];
        $_SESSION["ult_accion"]=time();

        header("Location:index.php");
        exit;

       }


    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Final PHP</title>
    <style>
        
        .error{
            color:red
        }
        .mensaje{
            color:blue;
            font-size:1.25em;
        }
    </style>
</head>
<body>
    <h1>Examen Final PHP</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>">
            <?php
            if(isset($_POST["btnLogin"]) && $error_usuario)
            {
                if($_POST["usuario"]=="")
                    echo "<span class='error'> Campo Vacío</span>";
                else
                    echo "<span class='error'> Usuario/clave incorrectos</span>";
            }
                
            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave">
            <?php
            if(isset($_POST["btnLogin"]) && $error_clave)
                echo "<span class='error'> Campo Vacío</span>";
            ?>
        </p>
        <p>
            <button type="submit" name="btnLogin">Login</button>
        </p>
    </form>
    
    <?php
    if(isset($_SESSION["seguridad"]))
    {
        echo "<p class='mensaje'>".$_SESSION["seguridad"]."</p>";
        session_destroy();
    }


    ?>  
</body>
</html>