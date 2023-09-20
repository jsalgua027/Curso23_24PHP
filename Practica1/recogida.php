<?php
if (isset($_POST["guardar"])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=h, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <h1> Recogida los datos</h1>
        <?php
        // array escalar , se accede por un indice númerico
        /* $a[0]=3;
    $a[1]=6;
    $a[2]= -1;
    $a[3]=8;
    
    for ($i=0; $i <count($a) ; $i++) { 
        echo "<p>Número: ".$a[$i]."</p>";
    }
    */
        /*
    cuando haces submti hay dos tipos de array que reciben todos los datos 

    $_post
    $_get
    
    estos son arrays asociativos  se localizan por el name que se pone en cada input
    */
        /*
     antes de esto hay que controlar  que se recogen los datos sino se da error
    */

        echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";
        echo "<p><strong>Apellidos: </strong>" . $_POST["apellidos"] . "</p>";
        echo "<p><strong>Contraseña: </strong>" . $_POST["clave"] . "</p>";
        echo "<p><strong>DNI: </strong>" . $_POST["dni"] . "</p>";
        // isset es si existe el dato muy importante
        if (isset($_POST["sexo"])) {
            echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";
        } else {
            echo "<p><strong>Sexo: </strong>No seleccionado.</p>";
        }
        echo "<p><strong>Nacido: </strong>" . $_POST["nacimiento"] . "</p>";

        echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";

        if (isset($_POST["boletin"])) {

            echo "<p><strong>Subscripcion: </strong>si</p>";
        } else {

            echo "<p><strong>Subscripcion: </strong>no</p>";
        }
        ?>
    </body>

    </html>

<?php } else {

    header("Location:index.php");
} ?>