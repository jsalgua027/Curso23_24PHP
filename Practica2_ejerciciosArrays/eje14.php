<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio14</h1>
    <?php
    $estadios_futbol=array("Barcelona"=>"Camp nou", "Real Madrid"=>"Santiago Bernabeu", "Valencia"=>"Mestalla", "Real Sociedad" =>"Anoeta");
        echo "<table>";

            foreach ($estadios_futbol as $equipo => $nombre_estadio) {
               // echo "<tr>".$equipo."<td>".$nombre_estadio."</td></tr>";
              
               echo "<tr><th>".$equipo."</th></tr>";
            
               echo "<tr><td>".$nombre_estadio."</td></tr>";
            }
        echo "</table>";
        // borro uno de los valores por indice; en este caso por el nombre del equipo
        unset($estadios_futbol["Real Madrid"]);
        echo "<h3>Despues de usar el unset</h3>";
        echo "<table>";

        foreach ($estadios_futbol as $equipo => $nombre_estadio) {
           // echo "<tr>".$equipo."<td>".$nombre_estadio."</td></tr>";
          
           echo "<tr><th>".$equipo."</th></tr>";
        
           echo "<tr><td>".$nombre_estadio."</td></tr>";
        }
    echo "</table>";
    
    
    ?>
</body>
</html>