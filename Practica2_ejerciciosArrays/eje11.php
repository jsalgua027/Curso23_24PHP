<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 11</h1>
    <?php
        $animales=array("Lagartija","Araña","Perro","Gato","Ratón");
        $numeros=array("12","34","45","52","12");
        $arboles=array("Sauce","Pino","Naranjo","Chopo","Perro","34");

        $todos_juntas=array_merge($animales,$numeros,$arboles);

        for ($i=0; $i <count($todos_juntas) ; $i++) { 
            echo "<p>".$todos_juntas[$i]."</p>";
        }

    
    ?>

</body>
</html>