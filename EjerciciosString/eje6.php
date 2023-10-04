<?php

// si hay campos vacios envia el error
if (isset($_POST["convertir"])) {
    $error_texto = $_POST["texto"] == "";

    $error_form = $error_texto;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .palabras {
            background-color: #D8EDF2;
            border: 2px solid black;
        }

        button {
            background-color: grey;
        }

        .verde {
            background-color: #D8F2D8;
            border: 2px solid black;
        }
    </style>
</head>

<body>
    <!--
     Escribe un formulario que pida una palabra o número y te diga si es o no un
palíndromo o un número capicúa:

-->
    <form action="eje6.php" method="post" enctype="multipar/form-data">
        <div class="palabras">
            <h1>Quitar acentos-Formulario</h1>
            <p>Escribe un texto y le quitaré los acentos.</p>
            <p>
                <label for="texto">Text: </label>
                <textarea type="textarea" name="texto" id="n1" value="<?php if (isset($_POST["texto"])) {
                                                                            echo $_POST["texto"];
                                                                        }
                                                                        ?>"></textarea>
                <?php
                if (isset($_POST["convertir"]) && $error_form) {

                    if ($_POST["texto"] == "") {
                        echo "<span class='error'>*Campo Obligatorio* </span>";
                    }
                }

                ?>
            </p>

            <p>
                <button type="submit" name="convertir">Quitar acentos</button>
            </p>
        </div>
    </form>
    <?php
    // si se le da ha comparar y no hay errores
    if (isset($_POST["convertir"]) && !$error_form) {
    ?>

        <br>
        <div class="verde">
            <h1>Quitar acentos-Resultado</h1>

            <?php
            $palabra = $_POST["texto"];
            // minusculas
            $palabra = str_replace('ú', 'u', $palabra);
            $palabra = str_replace('á', 'a', $palabra);
            $palabra = str_replace('é', 'e', $palabra);
            $palabra = str_replace('í', 'i', $palabra);
            $palabra = str_replace('ó', 'o', $palabra);
            // mayusculas
            $palabra = str_replace('Ú', 'U', $palabra);
            $palabra = str_replace('Á', 'A', $palabra);
            $palabra = str_replace('É', 'E', $palabra);
            $palabra = str_replace('Í', 'U', $palabra);
            $palabra = str_replace('Ó', 'O', $palabra);

            echo "<p>El texto original</p>";
            echo "<p>" . $_POST["texto"] . "</p>";
            echo "<p>El texto sin acentos</p>";
            echo "<p>" . $palabra . "</p>";

            ?>

        </div>
    <?php
    }
    ?>
</body>

</html>