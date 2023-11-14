<?php
    // llamo a la pagina con mis funciones 

    require "src/funciones.php";
    
    if (isset($_POST["btnGuardar"])) {
        
        $error_nombre=$_POST["nombre"]=""||strlen($_POST["nombre"])>50;
        $error_usuario=$_POST["usuario"]=""||strlen($_POST["usuario"])>30;
         // si no hay error en el usuario compruebo que no este repetido
        if(!$error_usuario){
            try {
                $conexion=mysqli_connect("localhost", "jose","josefa","bd_cv");
                mysqli_set_charset($conexion,"utf8");
            } catch (Exception $e) {
                die(error_page("Práctica 8","<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
            }
            $error_usuario=repetido($conexion,"usuarios","usuario",$_POST["usuario"]);
            
            if(is_string($error_usuario))
                die($error_usuario);

        }
        $error_clave = $_POST["clave"] == ""|| strlen($_POST["clave"])>50;
        $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
        // compruebo que el dni no este repetido 
        if(!$error_dni){

            try {
                $conexion=mysqli_connect("localhost", "jose","josefa","bd_cv");
                mysqli_set_charset($conexion,"utf8");
            } catch (Exception $e) {
                die(error_page("Práctica 8","<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
            }
            $error_dni=repetido($conexion,"usuarios","usuario",$_POST["dni"]);
            
            if(is_string($error_dni))
                die($error_dni);


        }
        $error_sexo = !isset($_POST["sexo"]); // si no existe 
        $error_archivo=  $_FILES["archivo"]["name"] != "" &&  ($_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024); 

        $error_form=$error_nombre||$error_usuario||$error_clave||$error_dni||$error_sexo||$error_archivo;

        // si no hay ningun error realizo la inserción de datos

        if(!$error_form){
           
                try {
                    $consulta="insert into usuarios (nombre,usuario,clave,dni,sexo) values ('".$_POST["nombre"]."','".$_POST["usuario"]."','".$_POST["clave"]."','".$_POST["dni"]."','".$_POST["sexo"]."')";
                } catch (Exception $e) {
                    die(error_page("Práctica 8","<h1>Práctica 8 </h1><p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p>"));
                }
                mysqli_close($conexion);

                header("Location:index.php");
                exit;
            // tengo que hacer el primer insert sin foto
            // una vez que hago eso compruebo si existe el archivo foto, si existe muevo el archivo a la carpeta y si tengo exito hago un pudate con la foto (img_id)
        }



    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
    <style>
        .erro{color:red}
    </style>
</head>
<body>
    <h2>Agregar Nuevo Usuario</h2>
    <form action="vista_nuevo.php" method="post" enctype="multipart/form-data" >
        <p>
            <label for="nombre">Nombre</label></br>
            <input type="text" name="nombre" id="nombre" maxlength="50" value="">
        </p>
        <p>
            <label for="usuario">Usuario</label></br>
            <input type="text" name="usuario" id="usuario" maxlength="30" value="">
        </p>
        <p>
            <label for="clave">Contraseña</label></br>
            <input type="password" name="clave" id="clave" maxlength="50" value="">
        </p>
        <p>
            <label for="dni">DNI</label></br>
            <input type="text" name="dni" id="dni" maxlength="50" value="">
        </p>
        <p>
            <label for="sexo">Sexo</label></br>
            <input type="radio" name="hombre" value="mujer">
            <label for="hombre">Hombre</label></br>
            <input type="radio" name="mujer" value="mujer">
            <label for="hombre">mujer</label>

        </p>
        <p>
        <label for="archivo">Seleccione un archivo imagen(Max 500KB)</label>
            <input type="file" name="archivo"  id="archivo" accept="image/*" >
        </p>

        <p>
            <button type="submit" name="btnGuardar">Guardar Cambios</button>
            <button type="submit" name="atras">Atrás</button>

        </p>
    </form>


</body>
</html>


<?php
echo"<h1>QUILLO AHORA SI ENTRO AQUI</h1>"

?>