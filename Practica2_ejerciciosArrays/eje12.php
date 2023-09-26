<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 12</h1>
    <?php
$animales = array("Lagartija", "Araña", "Perro", "Gato", "Ratón");
$numeros = array("12", "34", "45", "52", "12");
$arboles = array("Sauce", "Pino", "Naranjo", "Chopo", "Perro", "34");

$todos_juntas=array();

array_push($todos_juntas,$animales,$numeros,$arboles);
 // con este voy a mostar valores
foreach ($todos_juntas as $arr) {
    foreach ($arr as $valores) {
        echo "<p>".$valores."</p>";
    }
}

?>

</body>
</html>