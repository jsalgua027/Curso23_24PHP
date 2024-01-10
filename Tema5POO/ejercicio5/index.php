<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 POO</title>
</head>
<body>
    <h1>Ejercicio 5 POO</h1>
    <?php
    require "class_empleado.php";

    $empl1= new Empleado("2500","Juan Palomo");
    $empl2= new Empleado("4000","Maria Perez");

    echo "<h2>Informacion de mis empleados</h2>";

    $empl1->impuestos();
    $empl2->impuestos();
    
    
    ?>
</body>
</html>