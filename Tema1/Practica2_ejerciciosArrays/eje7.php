<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 7</h1>

    <?php

$ciudades[0] = "Madrid";
$ciudades[1] = "Barcelona";
$ciudades[2] = "Londres";
$ciudades[3] = "New York";
$ciudades[4] = "Los Angeles";
$ciudades[5] = "Chicago";
for ($i = 0; $i < count($ciudades); $i++) {
    echo "<p>EL indice del array que contiene " . $ciudades[$i] . " es: " . $i . "</p>";
}

?>

</body>
</html>