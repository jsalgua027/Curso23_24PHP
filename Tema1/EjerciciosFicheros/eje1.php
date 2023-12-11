<?php
if (isset($_POST["btnEnviar"])) {
    $error_form = $_POST["num"] == "" || !is_numeric($_POST["num"]) || $_POST["num"] < 1 || $_POST["num"] > 10;
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio ficheros. Texto</title>
</head>

<body>
    <h1>Ejercicio 1</h1>

    <form action="eje1.php" method="post">

        <p>

            <label for="texto1">Introduzca un número entre 1 y 10 (ambos inclusive):</label>
            <input type="text" name="num" id="num" value="<?php if (isset($_POST["num"])) echo $_POST["num"] ?>">
            <?php
            if (isset($_POST["btnEnviar"]) && $error_form) {

                if ($_POST["num"] == "") {

                    echo "<span class='error'> Campo vacio</span>";
                } else {

                    echo "<span class='error'> Error no has introducido el numero correctp</span>";
                }
            }


            ?>

        </p>
        <p>

            <button type="submit" name="btnEnviar">Crear Fichero</button>
        </p>

    </form>

    <?php

    if (isset($_POST["btnEnviar"]) && !$error_form) {

        $nombre_fichero = "tabla_" . $_POST["num"] . ".txt";
        if (!file_exists("Tablas/" . $nombre_fichero)) {
            @$sfd = fopen("Tablas/" . $nombre_fichero, "w");

            if (!$sfd) {

                die("<p> No se ha podidido crear el firchero 'Tablas/" . $nombre_fichero . "'");
            }
            for ($i = 1; $i <= 10; $i++) {
                // escribe cada linea 
                $linea = $i . " x " . $_POST["num"] . " = " . ($i * $_POST["num"]) . PHP_EOL;
                fputs($sfd, $linea);
            }
            fclose($sfd);
        }


        echo "<p>Fichero generado correctamente</p>";
    }



    ?>


</body>

</html>