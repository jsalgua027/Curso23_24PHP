<?php
// si hay campos vacios envia el error
if (isset($_POST["calcular"])) {

    
    // lo mejor meterlo  en una variable y de hay generar los errores
    $error_primeraFecha  = $_POST["fecha1"]== "";
    $error_segundaFecha  = $_POST["fecha2"]== "";
    $error_primeraFechaTama = strlen($_POST["fecha1"]) == 9;
    $error_segundaFechaTama = strlen($_POST["fecha2"]) == 9;
    $error_formatoSeparadoresFecha1 = substr($_POST["fecha1"], 2, 1) == "/" && substr($_POST["fecha1"], 5, 1) == "/";
    $error_formatoSeparadoresFecha2 = substr($_POST["fecha2"], 2, 1) == "/" && substr($_POST["fecha2"], 5, 1) == "/";
    $error_formatoNumeroFecha1 = is_numeric(substr($_POST["fecha1"], 0, 2)) && is_numeric(substr($_POST["fecha1"], 4, 2)) &&  is_numeric(substr($_POST["fecha1"], 6, 4));
    $error_formatoNumeroFecha2 = is_numeric(substr($_POST["fecha2"], 0, 2)) && is_numeric(substr($_POST["fecha2"], 4, 2)) &&  is_numeric(substr($_POST["fecha2"], 6, 4));
    $error_form = $error_primeraFecha || $error_segundaFecha || $error_segundaFechaTama || $error_primeraFechaTama ||  $error_formatoSeparadoresFecha1 ||
        $error_formatoSeparadoresFecha2 ||  $error_formatoNumeroFecha1 ||   $error_formatoNumeroFecha2;
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
     Escribe un formulario que pida dos palabras y diga si riman o no. Si
coinciden las tres últimas letras tiene que decir que riman. Si coinciden sólo
las dos últimas tiene que decir que riman un poco y si no, que no riman.
        
-->
    <form action="fecha1.php" method="post" enctype="multipar/form-data">
        <div class="palabras">
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
           
            ?>

        </div>
    <?php
    }
    ?>
</body>

</html>