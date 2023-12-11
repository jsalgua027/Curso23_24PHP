<?php
session_name("ejer_03_23_24");
session_start();

if (!isset($_SESSION["numero"])) {
    $_SESSION["numero"] = 0;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio3</title>
    <style>
        .text-centrado {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="text-centrado">SUBIR Y BAJAR NÚMERO</h1>
    <form action="sesiones03_2.php" method="post">

        <p>
            <button type="submit" name="boton" value="menos">-</button>

            <?php
            echo  $_SESSION["numero"];
            ?>

            <button type="submit" name="boton" value="mas">+</button>


        </p>
        <button type="submit" name="boton" value="cero">Poner a cero</button>

    </form>

</body>

</html>