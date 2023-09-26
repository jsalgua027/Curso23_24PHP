<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 9</h1>
</body>

    <?php
        $lenguajes_cliente=array("CSS","JavaScript","React","Vue","Angular","Swift");
        $lenguajes_servidor=array("Php","Python","Nodejs","Ruby","Java");

            $lenguajes=array_merge($lenguajes_cliente,$lenguajes_servidor);

            for ($i=0; $i <count($lenguajes) ; $i++) { 
                echo "<p>". $lenguajes[$i]."</p>";
            }
            echo "<h1>Lo hago en forma de tabla</h1><br/>";
            echo "<table>";
                echo "<tr>";
            for ($i=0; $i <count($lenguajes) ; $i++) { 
                echo "<th>". $lenguajes[$i]."</th>";
            }
                echo "</tr>";
                echo "</table>";
    ?>
</html>