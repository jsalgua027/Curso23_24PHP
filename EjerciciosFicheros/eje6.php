<?php

/**Ejercicio 6 
Modificar el ejercicio anterior realizando una web con un formulario que con-
tenga  un  select  con  las  iniciales  de  un  país  y  muestre  el  PIB  per  cápita  de  
todos los años disponibles del país seleccionado. 


cuando hago el form, abro y leo el fichero
tengo que recorrerlo y montar primero el select
 * 
 ultima parte de la primera col
 posi 0 hago un splode x , y me quedo con la 2 posi
 usa el end mejor.
 */



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 Fich. Texto</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 6</h1>
    <?php
    // URL del archivo de datos
    $ruta = 'http://dwese.icarosproject.com/PHP/datos_ficheros.txt';
    $fd = fopen($ruta, "r");
    if (!$fd) {
        die("<p>No se ha podido crear el fichero " . $ruta . "</p>");
    }
    echo "<p>Leyendo...</p>";

    //aqui todas y cada una de las filas
    $primera_linea = fgets($fd); //me salto la primera linea


    while ($linea = fgets($fd)) {
        $datos_linea = explode("\t", $linea);
        //echo var_dump($datos_linea);
        $datos_primera_col = explode(",", $datos_linea[0]);
        $paises[] = end($datos_primera_col);


        //aqui podriamos preguntar si ha echo submit y ocurre algo...
        //entonces me guardo la linea de nuevo

        if (isset($_POST["pais"]) && $_POST["pais"] == $datos_primera_col[2]) {
            $datos_pais_seleccionado = $datos_linea;
        }
    }

    fclose($fd);

    ?>
    <form action="eje6.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="pais">Seleccione un país</label>
            <select name="pais" id="pais">
                <?php
                for ($i = 0; $i < count($paises); $i++) {

                    if (isset($_POST["pais"]) && $_POST["pais"] == $paises[$i])

                        echo "<option selected value='" . $paises[$i] . "'>" . $paises[$i] . "</option>";
                    else
                        echo "<option value='" . $paises[$i] . "'>" . $paises[$i] . "</option>";
                }

                ?>
            </select>
        </p>

        <p>
            <button type="submit" name="btnBuscar">Buscar</button>

        </p>

    </form>

    <?php
    if (isset($_POST["btnBuscar"])) {
        echo "<h2>PIB per cápita de " . $_POST["pais"] . "</h2>";
        $datos_primera_fila = explode("\t", $primera_linea);
        //me quedo con los años
        $n_anios = count($datos_primera_fila) - 1;

        echo "<table>";
        echo "<tr>"; //primera fila


        for ($i = 0; $i <= $n_anios; $i++) {
            echo "<th>" . $datos_primera_fila[$i] . "</th>";
        }
        echo "</tr>";
        echo "<tr>"; //pais que seleccionamos


        for ($i = 0; $i <= $n_anios; $i++) {
            if (isset($datos_pais_seleccionado[$i]))
                echo "<td>" . $datos_pais_seleccionado[$i] . "</td>";
            else
                echo "<td></td>";
        }
        echo "</tr>";

        echo "</table>";
    }
    ?>

</body>

</html>