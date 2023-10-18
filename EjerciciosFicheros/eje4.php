<?php
if (isset($_POST["contar"])) {
    echo "<h1>" . $_FILES["fichero"]["type"] . "</h1>";

    $error_form = $_FILES["fichero"]["name"] == "" || $_FILES["fichero"]["error"] || $_FILES["fichero"]["type"] != "text/plain" || $_FILES["fichero"]["size"] > 2500 * 1024;
}



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio4 ficheros de texto</title>
</head>

<body>
    <h1>Ejercicio 4</h1>
    <form action="eje4.php" method="post" enctype="multipart/form-data">
        <P>

            <label for="fichero">Seleccione un fichero de texto para contar sus palabras (Max. 2.5 MB):</label>
            <input type="file" name="fichero" id="fichero" accept=".txt">
            <?php
            if (isset($_POST["contar"]) && $error_form) {
                if ($_FILES["fichero"]["name"] == "") {

                    echo "<span class='error'>*</span>";
                } else if ($_FILES["fichero"]["error"]) {
                    echo "<span class='error'>No se ha podido subir el fichero al servidor</span>";
                } else if ($_FILES["fichero"]["type"] != "text/plain") {
                    echo "<span class='error'>No has seleciconado un fichero</span>";
                } else {
                    echo "<span class='error'>Error en el tamaño</span>";
                }
            }



            ?>


        </P>
        <p>

            <button name="contar" type="submit">Contar palabras</button>
        </p>

    </form>
    <?php

    if (isset($_POST["contar"]) && !$error_form) {

      //  $contenido = file_get_contents($_FILES["fichero"]["tmp_name"]);
        // otra forma de hacerlo
        $fd= fopen($_FILES["fichero"]["tmp_name"],"r");

        if(!$fd){
                die("<p>No se puede abrir el fichero </p>");

        }
        $n_palabras=0;
        while ($linea =fgets($fd)) {
            $n_palabras+= str_word_count($linea);
        }




        //echo "<h3>El numero de palabras que contiene el archivo seleccionado es " . str_word_count($contenido) . "</h3>";
        echo "<h3>El numero de palabras que contiene el archivo seleccionado es " . $n_palabras . "</h3>";
    }


    ?>


</body>

</html>