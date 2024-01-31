<?php
require "src/ctes_funciones.php";
session_start();

if(isset($_POST["btnNuevoUsuario"]) || isset($_POST["btnContInsertar"]) )
{
    if(isset($_POST["btnContInsertar"])) // compruebo errores
    {
        $error_nombre=$_POST["nombre"]==""|| strlen($_POST["nombre"])>30;
        $error_usuario=$_POST["usuario"]==""|| strlen($_POST["usuario"])>20;
        if(!$error_usuario)
        {
            /* try{
                $conexion=mysqli_connect("localhost","jose","josefa","bd_foro");
                mysqli_set_charset($conexion,"utf8");
            }
            catch(Exception $e)
            {
                die(error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
            }

            $error_usuario=repetido($conexion,"usuarios","usuario",$_POST["usuario"]);
            */
              $url=DIR_SERV."/repetido/usuarios/usuario/".urlencode($_POST["usuario"]);
            $respuesta=consumir_servicios_REST($url,"GET");
            $obj=json_decode($respuesta);
            if(!$obj)
            {
                die(error_page("Primer crud_sw","<p>Error consumiendo el  servico ".$url."</p>"));
            }
            if(isset($obj->error))
            {
                die(error_page("Primer crud_sw","<p>Error consumiendo el  servico ".$obj->error."</p>"));
            }
            $error_usuario=$obj->repetido;
 

          
        }

        $error_clave=$_POST["clave"]=="" || strlen($_POST["clave"])>15;
        $error_email=$_POST["email"]=="" || strlen($_POST["email"])>50 || !filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);
        if(!$error_email)
        {
            $url=DIR_SERV."/repetido/usuarios/usuario/".urlencode($_POST["email"]);
            $respuesta=consumir_servicios_REST($url,"GET");
            $obj=json_decode($respuesta);
            if(!$obj)
            {
                die(error_page("Primer crud_sw","<p>Error consumiendo el  servico ".$url."</p>"));
            }
            if(isset($obj->error))
            {
                die(error_page("Primer crud_sw","<p>Error consumiendo el  servico ".$obj->error."</p>"));
            }
            $error_email=$obj->repetido;
 

            
        }
        $error_form=$error_nombre||$error_usuario||$error_clave||$error_email;

        if(!$error_form)
        {
            $url=DIR_SERV."/crearUsuario";
            $datos["nombre"]=$_POST["nombre"];
            $respuesta=consumir_servicios_REST($url,"GET");
            $obj=json_decode($respuesta);
            if(!$obj)
            {
                die(error_page("Primer crud_sw","<p>Error consumiendo el  servico ".$url."</p>"));
            }
            if(isset($obj->error))
            {
                die(error_page("Primer crud_sw","<p>Error consumiendo el  servico ".$obj->error."</p>"));
            }
            $error_usuario=$obj->repetido;
 

            header("Location:index.php");
            $_SESSION["mensaje"]="el usuario ha sido creado con exito";
            exit;
            
        }

        //Por aquí continuo sólo si hay errores en el formulario

        if(isset($conexion))
            mysqli_close($conexion);
        
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1º CRUD</title>
    <style>
        .error{color:red}
    </style>
</head>
<body>
    <h1>Usuario Nuevo</h1>
    <form action="usuario_nuevo.php" method="post">
        <p>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" maxlength="30" value="<?php  if(isset($_POST["nombre"])) echo $_POST["nombre"];?>">
            <?php
            if(isset($_POST["btnContInsertar"]) && $error_nombre)
            {
                if($_POST["nombre"]=="")
                    echo "<span class='error'> Campo vacío</span>";
                else
                    echo "<span class='error'> Has tecleado más de 30 caracteres</span>";
            }
            ?>
        </p>
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" name="usuario" id="usuario" maxlength="20" value="<?php  if(isset($_POST["usuario"])) echo $_POST["usuario"];?>" >
            <?php
            if(isset($_POST["btnContInsertar"]) && $error_usuario)
            {
                if($_POST["usuario"]=="")
                    echo "<span class='error'> Campo vacío</span>";
                elseif(strlen($_POST["usuario"])>20)
                    echo "<span class='error'> Has tecleado más de 20 caracteres</span>";
                else
                    echo "<span class='error'> Usuario repetido</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" maxlength="15" id="clave" >
            <?php
            if(isset($_POST["btnContInsertar"]) && $error_clave)
            {
                if($_POST["clave"]=="")
                    echo "<span class='error'> Campo vacío</span>";
                else
                    echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
            }
            ?>
        </p>
        <p>
            <label for="email">Email: </label>
            <input type="text" name="email" id="email" maxlength="50" value="<?php  if(isset($_POST["email"])) echo $_POST["email"];?>">
            <?php
            if(isset($_POST["btnContInsertar"]) && $error_email)
            {
                if($_POST["email"]=="")
                    echo "<span class='error'> Campo vacío</span>";
                elseif(strlen($_POST["email"])>50)
                    echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
                elseif(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
                    echo "<span class='error'> Email sintáxticamente incorrecto</span>";
                else
                    echo "<span class='error'> Email repetido</span>";
            }
            ?>
        </p>
        <p>
            <button type="submit" name="btnContInsertar">Continuar</button> 
            <button type="submit">Volver</button> 
        </p>
    </form>
</body>
</html>
<?php
}
else
{
    header("Location:index.php");
    exit;
}
?>