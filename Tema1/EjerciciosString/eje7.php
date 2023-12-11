<?php

// si hay campos vacios envia el error
if (isset($_POST["convertir"])) {
    $error_numero = $_POST["numero"] == "";

    $error_form = $error_numero;
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
    <form action="eje7.php" method="post" enctype="multipar/form-data">
        <div class="palabras">
            <h1>Quitar acentos-Formulario</h1>
            <p>Unifica el separador decimal-Formulario</p>
            
            <p>
                <label for="numero">Números: </label>
                <input type="text" name="numero" id="n1" value="<?php if (isset($_POST["numero"])) echo $_POST["numero"] ?>">
                <?php
                if (isset($_POST["convertir"]) && $error_form) {

                    if ($_POST["convertir"] == "") {
                        echo "<span class='error'>*Campo Obligatorio* </span>";
                    } 
                }

                ?>
            </p>
            

            <p>
                <button type="submit" name="convertir">Convertir</button>
            </p>
        </div>
    </form>
    <?php
    // si se le da ha comparar y no hay errores
    if (isset($_POST["convertir"]) && !$error_form) {
    ?>

        <br>
        <div class="verde">
            <h1>Unifica el separador decimal-Resultado</h1>

            <?php
            $numero = $_POST["numero"];
            // minusculas
            $numero = str_replace(',', '.', $numero);
           

            echo "<p>El texto original</p>";
            echo "<p>" . $_POST["numero"] . "</p>";
            echo "<p>El texto sin acentos</p>";
            echo "<p>" . $numero . "</p>";

            ?>

        </div>
    <?php
    }
    ?>
</body>

</html>