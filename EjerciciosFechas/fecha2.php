<?php





function fecha_valida($dia,$mes,$anio)
{
    return checkdate($mes,$dia,$anio);
}

// si hay campos vacios envia el error
if (isset($_POST["calcular"])) {



    //errores de fec1



    $error_fecha1 =   !fecha_valida($_POST["dia1"], $_POST["mes1"], $_POST["anyo1"]);
    //errores de fec2




    $error_fecha2 = !fecha_valida($_POST["dia2"], $_POST["mes2"], $_POST["anyo2"]);
    //--
    $error_form = $error_fecha1 || $error_fecha2;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .fechas {
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
     Escribe un formulario que pida dos palabras y diga si riman o no. Si
coinciden las tres últimas letras tiene que decir que riman. Si coinciden sólo
las dos últimas tiene que decir que riman un poco y si no, que no riman.

<
-->
    <form action="fecha2.php" method="post" enctype="multipar/form-data">
        <div class="fechas">
            <h1>Fecha-Formulario</h1>
            <p> cálculo de la diferencias de días entres dos fechas dadas.</p>
            <p>
                <label for="dia1">Dia:</label>
                <select name="dia1" id="dia1">
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        echo  "<option value='" . $i . "' >" . $i . "</option>";
                    }
                    ?>

                </select>
                <label for="mes1">Dia:</label>
                <select name="mes1" id="mes1">

                    <?php
                    $meses = [1 => "enero", 2 => "febrero", 3 => "marzo", 4 => "abril", 5 => "mayo", 6 => "junio", 7 => "julio", 8 => "agosto", 9 => "septiembre", 10 => "octubre", 11 => "noviembre", 12 => "diciembre"];
                    foreach ($meses as $key => $value) {
                        echo  "<option value='" . $key . "' >" . $value . "</option>";
                    }


                    ?>

                </select>
                <label for="anyo1">Año:</label>
                <select name="anyo1" id="anyo1">
                    <?php
                    for ($i = 1970; $i <= 2023; $i++) {
                        echo  "<option value='" . $i . "' >" . $i . "</option>";
                    }
                    ?>

                </select>

            </p>
            <p>
                <label for="dia2">Dia:</label>
                <select name="dia2" id="dia2">
                    <?php
                    for ($i = 1; $i <= 31; $i++) {
                        echo  "<option value='" . $i . "' >" . $i . "</option>";
                    }
                    ?>

                </select>
                <label for="mes2">Dia:</label>
                <select name="mes2" id="mes2">

                    <?php
                    $meses = [1 => "enero", 2 => "febrero", 3 => "marzo", 4 => "abril", 5 => "mayo", 6 => "junio", 7 => "julio", 8 => "agosto", 9 => "septiembre", 10 => "octubre", 11 => "noviembre", 12 => "diciembre"];
                    foreach ($meses as $key => $value) {
                        echo  "<option value='" . $key . "' >" . $value . "</option>";
                    }


                    ?>

                </select>
                <label for="anyo2">Año:</label>
                <select name="anyo2" id="anyo2">
                    <?php
                    for ($i = 1970; $i <= 2023; $i++) {
                        echo  "<option value='" . $i . "' >" . $i . "</option>";
                    }
                    ?>

                </select>

            </p>
            <p>
                <button type="submit" name="calcular">Calcular</button>
            </p>
        </div>
    </form>
    <?php
    // si se le da ha comparar y no hay errores
    if (isset($_POST["calcular"]) && !$error_form) {
    ?>
        <br>
        <div class="verde">
            <h1>Ripios_Resultados</h1>
            <?php


//!fecha_valida($_POST["dia1"], $_POST["mes1"], $_POST["anyo1"]);
            

            //una forma-------------> la comentada mejor
            $tiempo1=mktime(0,0,0, $_POST["mes1"], $_POST["dia1"], $_POST["anyo1"]);
            $tiempo2=mktime(0,0,0, $_POST["mes2"], $_POST["dia2"], $_POST["anyo2"]);
           

            $dif_segundos = abs($tiempo1 - $tiempo2);

            $dias_pasados = floor($dif_segundos / (60 * 60 * 24));

            echo "<p>La diferencia en días entre las dos fechas es: " . $dias_pasados . "</p>";


            ?>

        </div>
    <?php
    }
    ?>
</body>

</html>