<?php
// si hay campos vacios envia el error
if (isset($_POST["calcular"])) {

    
    
    //errores de fec1
    $buenos_separadores1 = substr($_POST["fec1"], 2, 1) == "/" && substr($_POST["fec1"], 5, 1) == "/";
    $numeros_buenos1 = is_numeric(substr($_POST["fec1"], 0, 2)) && is_numeric(substr($_POST["fec1"], 3, 2)) && is_numeric(substr($_POST["fec1"], 6, 4));
    $fecha_valida1 = checkdate(substr($_POST["fec1"], 3, 2), substr($_POST["fec1"], 0, 2), substr($_POST["fec1"], 6, 4));
    $error_fecha1 =  $_POST["fec1"] == "" || strlen($_POST["fec1"]) != 10 ||!$buenos_separadores1 || !$numeros_buenos1 || !$fecha_valida1;
    //errores de fec2
    $buenos_separadores1 = substr($_POST["fec2"], 2, 1) == "/" && substr($_POST["fec2"], 5, 1) == "/";
    $array_num2 = explode("/", $_POST["fec2"]);
    $numeros_buenos2 = is_numeric($array_num2[0]) && is_numeric($array_num2[1]) && is_numeric($array_num2[2]);
    $fecha_valida2 = checkdate($array_num2[1], $array_num2[0], $array_num2[2]);
    $error_fecha2 = $_POST["fec2"] == "" || strlen($_POST["fec2"]) != 10  || !$buenos_separadores2 || !$numeros_buenos2 || !$fecha_valida2;
    //--
    $error_form = $error_fecha1 || $error_fecha2;
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
        
-->
    <form action="fecha1.php" method="post" enctype="multipar/form-data">
        <div class="fechas">
            <h1>Fecha-Formulario</h1>
            <p> cálculo de la diferencias de días entres dos fechas dadas.</p>
            <p>
                <label for="fecha1">Introduce una fecha:(DD/MM/YYYY)</label>
                <input type="text" name="fecha1" id="fecha1" value="<?php if (isset($_POST["fecha1"])) echo $_POST["fecha1"] ?>">
                <?php
                if (isset($_POST["calcular"]) &&  $error_primeraFecha )   echo "<span class='error'>*Campo Obligatorio* </span>";
                else if (isset($_POST["calcular"]) && $error_primeraFechaTama) echo "<span class='error'>*La fecha No tiene 10 carcatere* </span>";
                else if (isset($_POST["calcular"]) &&   $error_formatoSeparadoresFecha1) echo "<span class='error'>No ha usado / para indicar la fecha* </span>";
                else if (isset($_POST["calcular"]) &&   $error_formatoNumeroFecha1) echo "<span class='error'>No ha usado numeros para dar la fecha* </span>";
                ?>
            </p>
            <p>
                <label for="fecha2">Introduce una fecha:(DD/MM/YYYY)</label>
                <!--En el value controlo que deje la informacion correcta -->
                <input type="text" name="fecha2" id="fecha2" value="<?php if (isset($_POST["fecha2"])) echo $_POST["fecha2"] ?>">
                <!--Dentro del <p> controlo el error del campo vacio con mensaje de error -->
                <?php
                if (isset($_POST["calcular"]) &&  $error_segundaFecha )   echo "<span class='error'>*Campo Obligatorio* </span>";
                else if (isset($_POST["calcular"]) && $error_segundaFechaTama) echo "<span class='error'>*La fecha No tiene 10 carcatere* </span>";
                else if (isset($_POST["calcular"]) &&   $error_formatoSeparadoresFecha2) echo "<span class='error'>No ha usado / para indicar la fecha* </span>";
                else if (isset($_POST["calcular"]) &&   $error_formatoNumeroFecha2) echo "<span class='error'>No ha usado numeros para dar la fecha* </span>";
                ?>
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

                $fecha1=strtotime($_POST["fecha1"]);
                $fecha2=strtotime($_POST["fecha2"]);
                $resultadoSegundos= abs($fecha1-$fecha2);
                $resultadoDias=$resultadoSegundos/86400;

                echo "<p>La diferencia en días entre las dos fechas es".$resultadoDias."</p>"



            ?>

        </div>
    <?php
    }
    ?>
</body>

</html>