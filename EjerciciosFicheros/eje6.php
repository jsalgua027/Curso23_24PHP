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
    
           
    
    ?>
    <form action="eje6.php" method="post" action=""></form>
</body>
</html>