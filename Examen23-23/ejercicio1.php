<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
</head>

<body>
    <form action="ejercicio1.php" method="post" enctype="multipart/form-data">
        <p>
        <h1>Ejercicio 1 . Generador de claves " Claver_polybios.txt"</h1>
        </p>
        <button type="submit" name="generar" id="Generar">Generar</button>



    </form>

    <?php
    if (isset($_POST["generar"])) {
        $fd = fopen("claves_polybios2.txt", "w");
        $numero = 0;
        if ($fd) {

            for ($i = 0; $i < 5; $i++) {
                $fd[$i] = $numero++;
            }
        }

    ?>
        <h2>Respuesta</h2>
        <textarea name="area" id="" cols="30" rows="10"></textarea>
        
    <?php
        echo $fd;
    };

    ?>
</body>

</html>