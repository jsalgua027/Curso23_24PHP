<?php
if(isset($_POST["btnEnviar"])){
    $error_nombre=$_POST["nombre"]=="";
    $error_sexo=!isset($_POST["sexo"]);
    $error_comentarios=$_POST["comentarios"]=="";
    $error_foto=$_FILES["foto"]["name"]==""||$_FILES["foto"]["error"]||!getimagesize($_FILES["foto"]["tmp_name"])||!explode(".",$_FILES["foto"]["name"])||$_FILES["foto"]["size"]>500*1024;

    $error_form= $error_nombre||$error_sexo||$error_comentarios|| $error_foto;

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
    <h1>Segundo Formulario</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>">
            <?php
            if(isset($_POST["btnEnviar"]) && $error_nombre)
            {
                echo "<span class='error'>*Campo obligatorio*</span>";

            } 
            
            ?>
        </p>
        <p>
            Nacido en:
            <select name="ciudades" id="ciudades">
                <option value="malaga"<?php if(isset($_POST["ciudades"])&& $_POST["ciudades"]=="malaga") echo"selected";?>>Málaga</option>
                <option value="cadiz"<?php if(isset($_POST["ciudades"])&& $_POST["ciudades"]=="cadiz") echo"selected";?>>Cádiz</option>
                <option value="almeria"<?php if(isset($_POST["ciudades"])&& $_POST["ciudades"]=="almeria") echo"selected";?>>Almeria</option>
            </select>
        </p>
        <p>
            Sexo:
            <label for="hombre" id="sexo">Hombre</label>
            <input type="radio" id="hombre" name="sexo" value="hombre"<?php if(isset($_POST["sexo"])&& $_POST["sexo"]=="hombre") echo"checked";?>>
            <label for="mujer" id="sexo">Mujer</label>
            <input type="radio" id="mujer" name="sexo" value="mujer"<?php if(isset($_POST["sexo"])&& $_POST["sexo"]=="mujer") echo"checked";?>>
            <?php
            if(isset($_POST["btnEnviar"])&&$error_sexo){
                echo "<span class='error'>*Campo obligatorio*</span>";
            }
            
            ?>
        </p>
        <p>
            Aficiones:
            <label for="deportes">Deportes</label>
            <input type="checkbox" id="deportes" name="aficiones[]" value="deportes" <?php if(isset($_POST["aficiones"])&& in_array("deportes",$_POST["aficiones"]))echo"checked";?>>
            <label for="lectura">Lectura</label>
            <input type="checkbox" id="lectura" name="aficiones[]" value="lectura" <?php if(isset($_POST["aficiones"])&& in_array("lectura",$_POST["aficiones"]))echo"checked";?>>
            <label for="otros">Otros</label>
            <input type="checkbox" id="otros" name="aficiones[]" value="otros" <?php if(isset($_POST["aficiones"])&& in_array("otros",$_POST["aficiones"]))echo"checked";?>>
        </p>

        <p>
            Comentarios:
            <textarea id="comentarios" name="comentarios"><?php if(isset($_POST["comentarios"])) echo $_POST["comentarios"]?></textarea>
        </p>
        <p>
            Incluir mi foto (Archivo de tipo imagen Máx 500KB):
            <input type="file" id="foto" name="foto" value="foto">
        </p>

        <p>
        <input type="submit"  name="btnEnviar" value="Enviar">
            <input type="submit"  name="btnBorrar" value="Borrar Campos">
    </form>
</body>

</html>