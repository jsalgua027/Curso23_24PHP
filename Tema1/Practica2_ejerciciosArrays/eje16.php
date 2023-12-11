<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Ejercicio 16</h1>
    <?php
    $eje16 = array(5 => 1, 12 => 2, 13 => 56, "x" => 42);
    foreach ($eje16 as $indice => $valor) {
        echo "<p>" . $valor . "</p>";
    }
    unset($eje16[5]);

    echo "<p>Despues del borrado de un elemento</p>";
    foreach ($eje16 as $indice => $valor) {
        echo "<p>" . $valor . "</p>";
    }

    echo "<p>Despues del borrado completo</p>";
    foreach ($eje16 as $indice => $valor) {
        unset($eje16[$indice]);
    }
    foreach ($eje16 as $indice => $valor) {
        echo "<p>" . $valor . "</p>";
    }

    ?>
</body>

</html>