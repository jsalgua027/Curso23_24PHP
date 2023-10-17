<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de ficheros</title>
</head>

<body>
    <h1>Teoría de ficheros</h1>
    <?php
    
    // funcion que abre ficheros  primero ruta , "r" leer , "w" escritura, "a" apertura !! SI AÑADIDMOS r+ lo hace mixto
    // @$fd1 = puntero que apunta al fichero
    @$fd1 = fopen("prueba.txt", "r+");
    //OJO CON LOS PERMISOS PARA APERTURA Y ESCRITURA HACEN FALTA
    if (!$fd1) { // si no existe
        // DIE como no existe lanza el mensaje y mata el proceso
        die("<p>No se ha podido abrir el ficehro</p>");
    }
    echo "<p>Por ahora todo en orden</p>";
    echo "<p>-------------------- Uso fgets------------------</p>";
    $linea = fgets($fd1);
    echo "<p>" . $linea . "</p>";
    $linea = fgets($fd1);
    echo "<p>" . $linea . "</p>";
    $linea = fgets($fd1);
    echo "<p>" . $linea . "</p>";
    $linea = fgets($fd1);
    echo "<p>" . $linea . "</p>";


    // lo hace al reves, le indicas hasta que posición
    echo "<p>-------------------- Uso fseek------------------</p>";
    // lo manda hasta la posicion 0
    fseek($fd1, 0);


    echo "<p> ----------------------Uso un while----------------</p>";

    while ($linea = fgets($fd1)) {
        echo "<p>" . $linea . "</p>";
    }

    // donde quiero escribir y el texto que quiero escibir !!   PERO LO TIENES QUE ABRIR EN ESCRITURA
    // Constante  para fin de linea PHP_EOL (end of de line)


    // fputs() o ferite()
    fwrite($fd1, "No me vas a dejar esciribir");

    fwrite($fd1, PHP_EOL . "Escribo con la constante final de linea");



    // cierro el fichero
    fclose($fd1);

    // para leer todo el fichero
    $todo_fichero=file_get_contents("prueba.txt");
   // echo "<pre>".$todo_fichero."</pre>"; para ver el contendo como en el documento
   echo nl2br($todo_fichero); // los saltos de linea  los muestra con un br

    ?>
</body>

</html>