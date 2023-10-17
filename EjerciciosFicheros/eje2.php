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
    <h1>Ejercicio 2</h1>

    <form action="eje2.php" method="post">

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
        // por comodidad guardo el nombre del fichero a buscar en una variable
        $nombre_fichero = "tabla_" . $_POST["num"] . ".txt";
        //veo que existe
        if (file_exists("Tablas/" . $nombre_fichero)) {
            // me guardo la ruta del fichero en otra variable por comodidad
            $ruta = "Tablas/" . $nombre_fichero;
            // abro el fichero en modo lectura
            $fd = fopen($ruta, "r");
            // Guardo toda la informacion en la variable todo fichero
            $todo_fichero = file_get_contents($ruta);
            //lo muestro
            echo nl2br($todo_fichero);

            // y lo cierro
            fclose($fd);
        } else {

            echo "<p>El fichero no existe</p>";
        }
    }



    ?>


</body>

</html>