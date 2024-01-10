<DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2.POO</title>
</head>

<body>
    <h1>Ejercicio 2.POO</h1>
    <?php
    require "class_fruta.php";
    //creo una variable que es una instancia de la clase fruta
    //imprimirlo
    echo "<h2>INFORMACIÓN DE FRUTA PERA:</h2>";
    $pera = new Fruta("verde", "mediano");
    ?>
</body>

</html>