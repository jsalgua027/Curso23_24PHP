<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 generador de claves</title>
</head>

<body>
    <h1>Ejercicio 1 generador de claves</h1>
    <form action="ejercicio1.php" method="post">

        <p>
            <button type="submit" name="generar">Generar</button>

        </p>

    </form>
    <?php
    if (isset($_POST["generar"])) {
        echo "<h1>Respuesta</h1>";
        // abro en modo escritura

        @$fd = fopen("claves_cesar.txt", "w");
        if (!$fd) {

            die("<p>el archivo no tiene los permisos de escitura</p>");
        }
        $primera_linea = "Letra/Desplazamineto";

        for ($i = 1; $i < ord("Z") - ord("A") + 1; $i++) {
            $primera_linea .= ";" . $i;
        }
        //  $cont_textarea=$primera_linea."\n"; otra forma metiendo cada linea en una variable para el textarea
        //escribo la linea
        fwrite($fd, $primera_linea . PHP_EOL);

        for ($i = ord("A"); $i <= ord("Z"); $i++) {
            // genero las letras con el chr()
            $linea = chr($i);
            for ($j = 1; $j <= ord("Z") - ord("A") + 1; $j++) {

                if ($i + $j <= ord("Z"))
                    $linea .= ";" . chr($i + $j);
                else {
                    $me_paso = ($i + $j) - ord("Z");
                    $posicion = ord("A") + $me_paso - 1;

                    $linea .= ";" . chr($posicion);
                }
            }
            //  $cont_textarea=$linea."\n"; otra forma metiendo cada linea en una variable para el textarea
            fwrite($fd, $linea . PHP_EOL);
        }
        fclose($fd);
        //echo"<textarea>".$cont_textarea."</textarea>";
    }
    // lo meto en el textarea
    echo "<textarea>" . file_get_contents("claves_cesar.txt") . "</textarea>";


    ?>
</body>
</html>