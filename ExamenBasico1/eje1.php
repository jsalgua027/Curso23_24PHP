
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
    <!--
    Realizar una página php con nombre ejercicio1.php, que contenga un
    formulario con un campo de texto y un botón. Este botón al pulsarse, nos
      va a modificar la página respondiendo cuántos caracteres se han
     introducido en el cuadro de texto.
    -->
</head>
<body>
        <form action="eje1.php" method="post" enctype="multipart/form-data">
            <label for="palabras">Escribe lo que quieras, vamos a contar Caracteres</label>
            <input type="text" name="palabras" id="palabras" value="">
            <button type="submit" name="comprobar">Comprobar</button>
        </form>    

    <?php
    $contador=0;
    $texto=$_POST["palabras"];
    
        while (isset($texto[$contador])) {
            $contador++;
        }

    
    
    ?>


</body>
</html>