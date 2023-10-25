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
        <p>
            <label for="frase">Escriba una frase</label>
            <input type="text" name="frase" id="frase" value="<?php if (isset($_POST["frase"])) echo $_POST["frase"] ?>">
        </p>
        <p>
            <label for="separador">Elija el separador</label>
            <select name="separacion" id="separacion">
                <!-- mantengo los campos, si existe el boton y el value de la opcion me pones selected-->
                <option <?php if (isset($_POST["comprobar"]) && $_POST["separacion"] == ",") echo "selected" ?> value=",">,</option>
                <option <?php if (isset($_POST["comprobar"]) && $_POST["separacion"] == ";") echo "selected" ?> value=";">;</option>
                <option <?php if (isset($_POST["comprobar"]) && $_POST["separacion"] == " ") echo "selected" ?> value=" ">espacio</option>
                <option <?php if (isset($_POST["comprobar"]) && $_POST["separacion"] == ":") echo "selected" ?> value=":">:</option>

            </select>
        </p>
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
        /*
          // mi explode
        function miExplode($frase, $separador)
        {
            $palabras = [];
            $contador = 0;
            $posiciones = 0;
            while (isset($frase[$posiciones])) {
                if ($frase[$posiciones] != $separador) {
                    $palabras[$contador] .= $frase[$posiciones];
                    $posiciones++;
                } else {
                    $contador++;
                    $posiciones++;
                }
            }
            return $palabras;
        }
        $sep = $_POST["separacion"];


        echo "<p>hay " .  count(miExplode($sep, $frase)) . " palabras </p>";
        */

      

        // funcion miguel angel
        function explodeMA($texto, $sepa)
        {
            $aux = [];
            $longitud = strlen($texto);
            $i = 0;

            while ($i < $longitud && $texto[$i] != $sepa)
                $i++;

            if ($i < $longitud) {
                $j = 0;
                $aux[$j] = $texto[$i];
                for ($i = $i + 1; $i < $longitud; $i++) {
                    if ($texto[$i] != $sepa) {
                        $aux[$j] .= $texto[$i];
                    } else {
                        while ($i < $longitud && $texto[$i] == $sepa)
                            $i++;

                        if ($i < $longitud) {
                            $j++;
                            $aux[$j] = $texto[$i];
                        }
                    }
                }
            }
            return $aux;
        }
        echo "<p>El número de palabras separadas por el separador es de : " . count(explodeMA( $_POST["frase"],$_POST["separacion"])) . "</p>";
    }


    ?>

</body>

</html>