
<?php

    if (isset($_POST["calcular"])) {

        $error_fecha1= $_POST["fecha1"]=="";
        $error_fecha2= $_POST["fecha2"]=="";

        $error_form= $error_fecha1||$error_fecha2;
        # code...
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
    <form action="fecha3.php" method="post" enctype="multipar/form-data">
        <div class="fechas">
            <h1>Fecha-Formulario</h1>
            <p> cálculo de la diferencias de días entres dos fechas dadas.</p>
            <p>
                <label for="fecha1">Dia:</label>
                <input type="date" id="fecha1" name="fecha1" value="<?php if (isset($_POST["fecha1"])) echo $_POST["fecha1"] ?>" min="1970-01-01" max="2024-01-01" />

                <?php
                  if(isset($_POST["calcular"]) && $error_fecha1){

                    echo"<p>tiene que seleccionar fecha</p>";

                  }

                ?>
              

            </p>
            <p>
                <label for="fecha2">Dia:</label>
                <input type="date" id="fecha2" name="fecha2" value="<?php if (isset($_POST["fecha2"])) echo $_POST["fecha2"] ?>" min="1970-01-01" max="2024-01-01" />

                <?php
                  if(isset($_POST["calcular"]) && $error_fecha2){

                    echo"<p>tiene que seleccionar fecha</p>";

                  }

                ?>
            </p>
            <p>
                <button type="submit" name="calcular">Calcular</button>
            </p>
        </div>
    </form>
    <?php
    // si se le da ha comparar y no hay errores
    if (isset($_POST["calcular"]) ) {
    ?>
        <br>
        <div class="verde">
            <h1>Ripios_Resultados</h1>
            <?php
            $fecha1 = $_POST["fecha1"];
            $fecha2 = $_POST["fecha2"];
            $pedazos_fecha1 = explode('-', $fecha1);
            $pedazos_fecha2 = explode('-', $fecha2);

            $ano1 = $pedazos_fecha1[0];
            $mes1 = $pedazos_fecha1[1];
            $dia1 = $pedazos_fecha1[2];

            $ano2 = $pedazos_fecha2[0];
            $mes2 = $pedazos_fecha2[1];
            $dia2 = $pedazos_fecha2[2];


            //una forma-------------> la comentada mejor
            $tiempo1 = mktime(0, 0, 0,  $mes1, $dia1, $ano1);
            $tiempo2 = mktime(0, 0, 0, $mes2, $dia2, $ano2);


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