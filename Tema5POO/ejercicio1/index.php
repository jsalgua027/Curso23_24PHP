<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 POO</title>
</head>
<body>
        <h1>EJERCICIO 1 POO</h1>
        <?php
            require "class_fruta.php";    
            //creo el objeto    
        $pera= new Fruta();
         // le doy datos con los setters
        $pera->set_color("verde");
        $pera->set_tamanyo("mediano");

        echo"<h2>Informacion de mi pera</h2>";
        echo"<p>color: ".$pera->get_color()."</p>";
        echo"<p>Tamanio: ".$pera->get_tamanyo()."</p>"
        
        ?>    

</body>
</html>