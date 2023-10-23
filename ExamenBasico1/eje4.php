<?php
if (isset($_POST["subir"])) {

    $error_form = $_FILES["archivo"]["name"] == "" || $_FILES["archivo"]["error"] || $_FILES["archivo"]["type"] != "text/plain" || $_FILES["archivo"]["size"] > 1000 * 1024;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <style>
        .error {

            color: red;
        }
    </style>
</head>

<body>
    <form action="eje4.php" method="post" enctype="multipart/form-data">

        <p>
        <h1>Ejercicio 4</h1>
        </p>
        <p><label for="archivo">Seleccione un archivo txt no superior a 1MB</label>
            <input type="file" name="archivo" id="archivo" accept=".txt">
        </p>
        <?php
        if (isset($_POST["subir"]) && $error_form) {
            if ($_FILES["archivo"]["name"] == "") {
                echo "<p class='error'>El archivo esta vacio</p>";
            } else if ($_FILES["archivo"]["error"]) {
                echo "<p class='error'>No se ha podido subir el archivo al servidor</p>";
            } else if ($_FILES["archivo"]["size"]) {
                echo "<p class='error'>El tamaño del archivo es incorrecto</p>";
            } else if ($_FILES["archivo"]["type"] != ".txt") {
                echo "<p class='error'>El formato del archivo no es el correcto</p>";
            }
        }

        ?>
        <p><button type="submit" name="subir">Subir</button></p>

    </form>

    <?php
    if(isset($_POST["subir"])&& !$error_form){
        
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>Ejercicio 4</h1>
        <h2>Horarios de los profesores</h2>
        <form action="eje4.php" method="get" enctype="multipart/form-data">
            <p>
                <label for="horarios"></label>
                <option value="" names="opt" id="opt">

                </option>
            </p>
        </form>
    </body>
    </html>

    <?php    
    }
    ?>


</body>

</html>