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