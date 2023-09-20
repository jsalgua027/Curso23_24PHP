<?php
if (isset($_POST["enviar"])) {
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Recogida de datos </h1>
    <?php

    echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";

    if (isset($_POST["nacimiento"])) {

        echo "<p><strong>Nacido: </strong>" . $_POST["nacimiento"] . "</p>";
    } else {

        echo "<p><strong>Nacido: </strong>No seleccionado.</p>";
    }

    if (isset($_POST["sexo"])) {

        echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";
    } else {

        echo "<p><strong>Sexo: </strong>No seleccionado.</p>";
    }

    if (isset($_POST["deportes"])) {

        echo "<p><strong>Deportes: </strong>Si.</p>";
    } else {

        echo "<p><strong>Deportes: </strong>No.</p>";
    }

    if (isset($_POST["lectura"])) {

        echo "<p><strong>Lectura: </strong>Si.</p>";
    } else {

        echo "<p><strong>Lectura: </strong>No.</p>";
    }

    if (isset($_POST["Otros"])) {

        echo "<p><strong>Otros: </strong>Si.</p>";
    } else {

        echo "<p><strong>Otros: </strong>No.</p>";
    }

    echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";

    ?>

</body>
</html>
<?php
} else {

    header("Location:index.php");
}
?>