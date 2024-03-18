<?php
if(isset($_POST["guardar"]))
{
   $error_usuario=$_POST["usuario"]=="";
   $error_nombre=$_POST["nombre"]=="";
   $error_clave=$_POST["clave"]=="";
   $error_dni=$_POST["dni"]=="";
   $error_sexo=!isset($_POST["sexo"]);
   $error_boletin=!isset($_POST["boletin"]);
   $error_archivo=$_FILES["foto"]["name"]=="" || $_FILES["foto"]["error"]||!getimagesize($_FILES["foto"]["tmp_name"])||$_FILES["foto"]["size"]>500*1024 ||!isset(explode(".",$_FILES["foto"]["name"]));

    $error_form=$error_usuario||$error_nombre||$error_clave||$error_dni||$error_sexo||$error_boletin || $error_archivo;




}
if(isset($_POST["guardar"])&& !$error_form){

    $nombre_nuevo = md5(uniqid(uniqid(), true));
    @$var = move_uploaded_file($_FILES["archivo"]["tmp_name"], "images/" . $nombre_nuevo);

/* if ($var) {
          
            echo "<h3>Foto</h3>";
            echo "<p><strong>Nombre: </strong>" . $_FILES["archivo"]["name"] . "</p>";
            echo "<p><strong>Tipoe: </strong>" . $_FILES["archivo"]["type"] . "</p>";
            echo "<p><strong>Tamanio: </strong>" . $_FILES["archivo"]["size"] . "</p>";
            echo "<p><strong>Error: </strong>" . $_FILES["archivo"]["error"] . "</p>";
            echo "<p><strong>Archivo en el temporal del servidor : </strong>" . $_FILES["archivo"]["tmp_name"] . "</p>";
            echo "<p>La imagen subida con exito</p>";
            echo "<p><img class='tan_img' src='images/" . $nombre_nuevo . "' alt='Foto' title='Foto'/></p>";
        } else {

            echo "<span> NO se ha podido mover la imgen a la carpeta destino en el servidor</span>";
        }*/

        echo"<h1>DATOS ENVIADOS</h1>";
        echo"<p>El usuario:". $_POST["usuario"]."</p>";
        echo"<p>Con nombre:". $_POST["nombre"]."</p>";
        echo"<p>Dni:". $_POST["dni"]."</p>";




}

    
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            color:red
        }

    </style>

</head>

<body>
    <h1>Rellena tu Cv</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="usuario">Usuario:</label></br>
            <input type="text" name=usuario id="usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"]?>">
            <?php
                if(isset($_POST["guardar"]) && $error_usuario){
                    echo"<span class='error'>*Campo Obligatirio*</span>";
                }
            
            
            ?>
        </p>

        <p>
            <label for="nombre">Nombre:</label></br>
            <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"]?>">
            <?php
                if(isset($_POST["guardar"]) && $error_nombre){
                    echo"<span class='error'>*Campo Obligatorio*</span>";
                }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label></br>
            <input type="password" name="clave" id="clave">
            <?php
                if(isset($_POST["guardar"])&& $error_clave){
                    echo"<span class='error'>*Campo Obligatorio*</span>";
                }
            ?>
        </p>
        <p>
            <label for="dni">DNI:</label></br>
            <input type="text" name="dni" id="dni" value="<?php if(isset($_POST["clave"])) echo$_POST["dni"]?>">
            <?php
                if(isset($_POST["guardar"])&& $error_dni){
                    echo"<span class='error'>*Campo Obligatorio*</span>";
                }
            ?>


        <p>
            <label for="sexo">Sexo:</label></br>
            <input type="radio" name="sexo" id="hombre" value="hombre" <?php if(isset($_POST["sexo"]) && ($_POST["sexo"]=="hombre")) echo"checked";?>> <label for="hombre">Hombre</label></br>
            <input type="radio" name="sexo" id="mujer" value="mujer" <?php  if(isset($_POST["sexo"]) && ($_POST["sexo"]=="mujer")) echo "checked";?>> <label for="mujer">Mujer</label>
            <?php
                if(isset($_POST["guardar"])&& $error_sexo){
                    echo"<span class='error'>*Campo Obligatorio*</span>";
                }
            
            ?>
        </p>

        <p>
            <label for="foto">Incluir mi foto (Max 500kb)</label>
            <input type="file" name="foto" id="foto" accept="image/*">
                <?php
                    if(isset($_POST["guardar"])&& $error_archivo){
                        if($_FILES["foto"]["name"]!=""){
                            if($_FILES["foto"]["error"]){
                                echo "<span class='error'> No se ha podido subir el archivo al servidor</span>";
                            }elseif (!getimagesize($_FILES["foto"]["tmp_name"])) {

                                echo "<span class='error'>El archivo seleccionado no es una fotografia</span>";
                            } else {
                                echo "<span class='error'> El archivo seleccionado supera los 500 MAX</span>";
                            }
                        }


                    }
                ?>
        </p>

        <p>

            <input type="checkbox" name="boletin" id="boletin" />
            <label for="boletin">Suscribirme al boletin de novedades </label>
            <?php
                if(isset($_POST["guardar"])&& $error_boletin){
                    echo"<span class='error'>*Campo Obligatorio*</span>";
                }
            
            ?>
        </p>
        <p>

            <button type="submit" name="guardar"> Guardar cambios</button>
            <button type="reset" name="borrar"> Borrar los datos</button>

        </p>
    </form>
</body>

</html>