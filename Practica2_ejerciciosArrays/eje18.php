<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Ejercicio 18</h1>
</body>
<?php

$deportes = array("Futbol", "Baloncesto", "Natación", "Tenis");

for ($i = 0; $i < count($deportes); $i++) {
    echo "<p>" . $deportes[$i] . "</p>";
}
echo "<p>El array contiene " . count($deportes) . " elmentos.</p>";// cuantos elementos
echo "<p>El primer valor es " . current($deportes) . "</p>"; // en cual estas
echo "<p>El segundo valor es " . next($deportes) . "</p>"; // pasar al siguente
echo "<p>El último valor es " . end($deportes) . "</p>"; // el ultimo
echo "<p>El penúltimo valor es " . prev($deportes) . "</p>";// retrocede y muestra

?>

</html>