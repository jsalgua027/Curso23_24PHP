<?php
    if(isset($_POST["btnEnviar"])){
        $error_nombre=$_POST["nombre"]=="";
        $error_sexo=!isset($_POST["sexo"]);
        $error_comentarios=$_POST["comentarios"]=="";
        $error_archivo=$_FILES["archivo"]["name"]==""||$_FILES["archivo"]["error"]||!getimagesize($_FILES["archivo"]["tmp_name"])|| explode(".",$_FILES["archivo"]["name"]) || $_FILES["archivo"]["size"]>500*1024;
        $error_form=$error_nombre||$error_sexo||$error_comentarios||$error_archivo;




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
            <input type="text" id="nombre" name="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
            <?php
                if(isset($_POST["btnEnviar"])&& $error_nombre){
                    echo "<span class='error'>*Campo obligatorio*</span>";
                }
            ?>
        </p>
        <p>
            <label for="ciudad">Nacido en :</label>
            <select name="ciudad" id="ciudad">
                <option value="malaga">Málaga</option>
                <option value="cadiz">Cádiz</option>
                <option value="granada">Granada</option>
            </select>
        </p>

        <p>
            Sexo:
            <label for="hombre">Hombre</label>
            <input type="radio" id="hombre" name="sexo" value="hombre" <?php if(isset($_POST["sexo"])&& $_POST["sexo"]=="hombre") echo "checked"?>>
            <label for="mujer">Mujer</label>
            <input type="radio" id="mujer" name="sexo" value="mujer" <?php if(isset($_POST["sexo"])&& $_POST["sexo"]=="mujer") echo "checked"?>>
            <?php
                if(isset($_POST["btnEnviar"])&& $error_sexo){
                    echo "<span class='error'>*Campo obligatorio*</span>";
                }
            ?>
        </p>

        <p>
            Aficiones:
            <label for="deportes">Deportes</label>
            <input type="checkbox" id="deportes" name="deportes" value="deportes">
            <label for="lectura">Lectura</label>
            <input type="checkbox" id="lectura" name="lectura" value="lectura">
            <label for="otros">Otros</label>
            <input type="checkbox" id="otros" name="otros" value="otros">
        </p>
        <p>
            <label for="comentarios">Comentarios:</label>
            <textarea id="comentarios" name="comentarios"></textarea>
            <?php
                if(isset($_POST["btnEnviar"])&& $error_comentarios){
                    echo "<span class='error'>*Campo obligatorio*</span>";
                }
            ?>
        </p>
        <p>
            <label for="archivo">Incluir mi foto (Archivo de tipo imagen Máx 500KB)</label>
            <input type="file" id="archivo" name="archivo"accept="image/*" >
        </p>
        <p>
            <input type="submit"  name="btnEnviar" value="Enviar">
            <input type="submit"  name="btnBorrar" value="Borrar">
        </p>
    </form>
</body>

</html>