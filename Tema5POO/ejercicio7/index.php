<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJERCICIO 7</title>
</head>
<body>
    <h1>Ejercicio 7 Peliculas</h1>
    <?php
        require 'class_pelicula.php';
        $pelicula=new Pelicula("Indiana Jones", "Espliver",42.5,true,"2024/1/01");
        echo"<p><strong>Titulo: </strong>".$pelicula->getNombre().".</br>";
        echo"<strong>Director: </strong>".$pelicula->getDirector().".</br>";
        echo"<strong>Precio: </strong>".$pelicula->getPrecio().".</br>";
        if($pelicula->getAlquilada())
        {
            echo"<strong>Estado: </strong>Alquilada.</br>";
        }else{
            echo"<strong>Estado: </strong>Disponible.</br>";
        }
        echo"<strong>Fecha prevista devolucion: </strong>".$pelicula->getFechaPrevDevolucion().".</br>";
        echo"<strong>Recargo actual: </strong>".$pelicula->calcularRecargo().".<p>";
    
    ?>
</body>
</html>