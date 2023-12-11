<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
   <!-- comentario html -->
    <h1>teoria elemental php</h1>

    <!-- Pasa declarar variables se ponde $ y el nombre -->
    <!-- se concatena con el (.) -->
    <?php
    define("PI", 3.1415); // declaro una constante para usarla no es necesario las comillas
    echo "<p> hola a todos</p>";
    $a = 8;
    $b = 9;
    $c = $b + $a;

    echo "<p> EL resultado de sumar " . $a . " + " . $b . " = " . $c . "</p>";
    // sentencia condicional
    if (3 > $c) {

        echo "<p> 3 es mayor que " . $c . "</p>";
    } elseif ($c == 3) {
        echo "<p> 3 es igual que " . $c . "</p>";
    } else {
        echo "<p> 3 es menor que " . $c . "</p>";
    }
    $d = 0;
    switch ($d) {
        case 1:
            $c = $a - $b;
            break;

        case 2:
            $c = $a / $b;
            break;

        case 3:
            $c = $a * $b;
            break;

        default:
            $c = $a + $b;
            break;
    }

    echo "<p> el resultado del switch es:" . $c . "</p>";

    // bucles for

    for ($i = 0; $i < 8; $i++) {
        echo "<p>Hola " . ($i + 1) . "</p>";
    }


    $i = 0;
    // bucle while
    while ($i <= 8) {
        echo "<p>Hola " . ($i + 1) . "</p>";
        $i++; //evito que sea infinito
    }


    ?>


</body>

</html>