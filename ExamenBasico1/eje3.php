<?php
if (isset($_POST["comprobar"])) {
    $erro_form = $_POST["frase"] == "";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- 
    Realizar una página php con nombre ejercicio3.php, que contenga un
formulario con un campo de texto, un select y un botón. Este botón al
pulsarse, nos va a modificar la página respondiendo cuántas palabras hay
en el cuadro de texto según el separador seleccionado en el select
(“,”,”;”,”(espacio)“,”:”)
Se hará un control de error cuando en el cuadro de texto no se haya
introducido nada


    -->
    <style>
        .error {

            color: red;
        }
    </style>

</head>

<body>
    <form action="eje3.php" method="post" enctype="multipart/form-data">
        <label for="frase">Escriba una frase</label>
        <input type="text" name="frase" id="frase" value="<?php if (isset($_POST["frase"])) echo $_POST["frase"] ?>">

        <select name="separacion" id="separacion">
            <option value=",">,</option>
            <option value=";">;</option>
            <option value=" ">espacio</option>
            <option value=":">:</option>

        </select>

        <button type="submit" name="comprobar">Comprobar</button>
        <?php
        if (isset($_POST["comprobar"]) && $erro_form) {
            echo "<p class='error'>El campo esta vacio</p>";
        }


        ?>
    </form>
    <?php
    if (isset($_POST["comprobar"]) && !$erro_form) {
        $frase = $_POST["frase"];
        echo "<p>La frase es:     " . $frase . "</p>";
        $contador = 0;
        $posiciones = 0;

        if ($_POST["separacion"] == ",") {
            while (isset($frase[$posiciones])) {
                if ($frase[$posiciones] == ",") $contador++;
                $posiciones++;
                if(end($frase)== ","){
                    $contador--;
                }
            }

            echo "<p>hay " . ($contador + 1) . " palabras </p>";
        } else if ($_POST["separacion"] == " ") {
            while (isset($frase[$posiciones])) {
                if ($frase[$posiciones] == " ") $contador++;
                $posiciones++;
                if(end($frase)== " "){
                    $contador--;
                }
            }
            echo "<p>hay " . ($contador + 1) . " palabras </p>";
        } else if ($_POST["separacion"] == ";") {
            while (isset($frase[$posiciones])) {
                if ($frase[$posiciones] == ";") $contador++;
                $posiciones++;
                if(end($frase)== ";"){
                    $contador--;
                }
            }
            echo "<p>hay " . ($contador + 1) . " palabras </p>";
        } else if ($_POST["separacion"] == ":") {
            while (isset($frase[$posiciones])) {
                if ($frase[$posiciones] == ":") $contador++;
                $posiciones++;
                if(end($frase)== ":"){
                    $contador--;
                }
            }
            echo "<p>hay " . ($contador + 1) . " palabras </p>";
        }
    }


    ?>

</body>

</html>