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
    if ((isset($_POST["subir"]) && !$error_form) || isset($_POST["horarios"])) {


        $fd = fopen("Horarios/" . $_FILES["archivo"]["name"], "r");

        if (!$fd) {
            die("<p>No se ha podido crear el fichero</p>");
        }
        echo "<p>Leyendo...</p>";

        while ($linea = fgets($fd)) {
            // divido por tabulador
            $datos_linea = explode("\t", $linea);
            // me quedo con la primera posicion y divido por , pasa sacar los porfesores
            $profesores[] = $datos_linea[0];
        }

    ?>

        <h1>Ejercicio 4</h1>
        <h2>Horarios de los profesores</h2>
        <form action="eje4.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="horarios"></label>
                <select name="horarios" id="horarios">
                    <?php
                    for ($i = 0; $i < count($profesores); $i++) {
                        if (isset($_POST["profesores"]) && $_POST["profesores"] == $profesores[$i]) {

                            echo "<option selected value='" . $profesores[$i] . "'>" . $profesores[$i] . "</option>";
                            $datos_profesor_seleci=$datos_linea;
                        } else {
                            echo "<option value='" . $profesores[$i] . "'>" . $profesores[$i] . "</option>";
                        }
                    }

                    ?>
                </select>
                <button type="submit" name="horarios">Ver horarios</button>
            </p>
        </form>
        <?php
        if (isset($_POST["horarios"]) ) {

            echo "<h2> estoy aqui</h2>";

            echo " <table border='1'>";
            echo "<tr>";
            echo " <th></th>";
            echo " <th>Lunes</th>";
            echo "<th>Martes</th>";
            echo " <th>Miércoles</th>";
            echo " <th>Jueves</th>";
            echo " <th>Viernes</th>";
            echo " <th>Sábado</th>";
            echo " <th>Domingo</th>";
            echo "</tr>";
        }


        ?>



    <?php

    }

    ?>


</body>

</html>