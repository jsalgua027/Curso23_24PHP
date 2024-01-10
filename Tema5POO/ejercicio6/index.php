<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    <h2>Ejercicio 6</h2>
    <?php
    require "class_Menu2.php";

    $n=New Menu2();
    $n->cargar('http://www.as.com','DiarioAs');
    $n->cargar('http://www.Marca.com','Marca');
    $n->cargar('http://www.hsn.com','HSN');
    $n->vertical();
    $n->horizontal();



    ?>
   
</body>
</html>