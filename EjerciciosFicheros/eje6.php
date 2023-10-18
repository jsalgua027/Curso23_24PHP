<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    
    <?php 
    // primero abro en modo lectura el archivo
    $fd = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");

    if(!$fd){
        die("<p>No se ha podido abrir el fichero: http://dwese.icarosproject.com/PHP/datos_ficheros.txt </p>");
        
    }
    // cojo cada linea
    $linea=fgets($fd);
    $datos_linea=explode("\t",$linea);
    $n_columnas=count($datos_linea);

    while($linea=fgets($fd)){
        $datos_linea1=explode(",",$linea);
      $nu =explode(" ", $datos_linea1[2]);
    //  $va=substr($datos_linea1[2],2);
       
       
       
        echo"<tr>";
       echo "<th>".$nu[0]."</th></br>";
      //  echo "<th>".$va."</th></br>";
      //  echo "<th>".$datos_linea1[2]."</th></br>";
        echo"</tr>";

    }
    echo"</br>";
    echo"PRUEBA--------------------SEPARACION";
/*   echo"<tr>";
    for ($i=0; $i <$n_columnas ; $i++) { 
        echo"<th>".$datos_linea[$i]."</th>";
    }

    echo "</tr>";
       */
   
           
    
    ?>
    
    <form action="eje6.php" method="post" action=""></form>
</body>
</html>