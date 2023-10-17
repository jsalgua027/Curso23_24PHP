<?php
if (isset($_POST["btnEnviar"])) {
    $error_num1 = $_POST["num"] == "" || !is_numeric($_POST["num"]) || $_POST["num"] < 1 || $_POST["num"] > 10;
    $error_num2 = $_POST["num2"] == "" || !is_numeric($_POST["num2"]) || $_POST["num2"] < 1 || $_POST["num2"] > 10;

    $error_form= $error_num1||$error_num2;

}

// para el cuatro usar str_word_count para contar
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio ficheros. Texto</title>
</head>

<body>
    <h1>Ejercicio 3</h1>

    <form action="eje3.php" method="post">

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

            <label for="texto1">Introduzca un número entre 1 y 10 (ambos inclusive):</label>
            <input type="text" name="num2" id="num2" value="<?php if (isset($_POST["num2"])) echo $_POST["num2"] ?>">
            <?php
            if (isset($_POST["btnEnviar"]) && $error_form) {

                if ($_POST["num2"] == "") {

                    echo "<span class='error'> Campo vacio</span>";
                } else {

                    echo "<span class='error'> Error no has introducido el numero correctp</span>";
                }
            }


            ?>

        </p>
        <p>

            <button type="submit" name="btnEnviar">Comprobar</button>
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

            $contador=1;
            /*  con bucle while

             while ($contador <= $_POST["num2"]) {
                $linea=fgets($fd);
                $contador++;
                
            }
            */ 
            // con bucle for
            for ($i=0; $i <$_POST["num2"] ; $i++) { 
                $linea=fgets($fd);
            }
            
            echo"<p>".$linea."</p>";
        

            // y lo cierro
            fclose($fd);
        } else {

            echo "<p>El fichero no existe</p>";
        }
    }



    ?>


</body>

</html>