<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        table, td, tr, th{ 
            border:1px solid black;
        }
    </style>
</head>
<body>
    <h1>Ejercicio 9</h1>
</body>

    <?php
        $lenguajes_cliente=array("lp1"=>"CSS","lp2"=>"JavaScript","lp3"=>"React","lp4"=>"Vue","lp5"=>"Angular");
        $lenguajes_servidor=array("ls1"=>"Php","ls2"=>"Python","ls3"=>"Nodejs","ls4"=>"Ruby","ls5"=>"Java");

            $lenguajes=array_merge($lenguajes_cliente,$lenguajes_servidor);

            /*
            sin metodos 
            $lenguajes=$lenguajes_cliente;

          foreach ($lenguajes_servidor as $leng => $de) {
            $lenguajes[$leng]=$de;
          }

            */
          

            echo "<table>";
            echo "<tr><th>Lenguajes</th></tr>";
            foreach ($lenguajes as $nivel => $tipo) {
                echo "<tr>";
                echo "<td>". $nivel."</td>";
                echo "<td>". $tipo."</td>";
                echo "</tr>";
            }
                
            
               
                echo "</table>";
    ?>
</html>