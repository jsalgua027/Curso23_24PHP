<?php

$ruta = "https://educacionadistancia.juntadeandalucia.es/centros/malaga/pluginfile.php/385150/mod_resource/content/1/horarios.txt";

/**Ejercicio 4 (5 ptos) 
 Realizar una página php con  nombre ejercicio4.php,  que al cargar 
compruebe  si  en  una  carpeta  con  nombre  Horario,  existe  el  archivo  
“horarios.txt”. Si no existe la página tendrá la siguiente apariencia: 
 * 
 * APEL, APEL, NOMBRE, DIA, HORA, ASIGNATURA
 * 
 * intento abrirlo, 
 * que no está muestro esto
 * que esta lo otro
 */
//CONTROL DE ERRORES
if (isset($_POST["btnSubir"])) {


    $error_form = $_FILES["fichero"]["name"] == ""
        || $_FILES["fichero"]["error"]
        || $_FILES["fichero"]["type"] != "text/plain"
        || $_FILES["fichero"]["size"] > 1000 * 1024;
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4SolProf</title>
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
        .error {
            color: red;
        }

        .text_centrado {
            text-align: center;
        }


  
    </style>
</head>

<body>
    <h1>Ejercicio 4SolProf</h1>

    <?php

    if (isset($_POST["btnSubir"]) && !$error_form) {
        //echo $_FILES["fichero"]["tmp_name"];
        @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"], "Horarios/horarios.txt");


        if (!$var) {
            echo "<h3>No se ha podido mover a la carpeta destino</h3>";
        }
    }
    //START****************
    //trato de abrir el fichero
    //ver si lo puede abrir en modo lectura
    @$fd = fopen("Horarios/horarios.txt", "r");

    if ($fd) {
        //si open
        $options = "";

        while ($linea = fgets($fd)) {
            $datos_linea = explode("\t", $linea);
            //datos linea0 tengo el nom del prof.
             $profesores[] = $datos_linea[0];

         

             if(isset($_POST["btnVerHorario"])&& $_POST["profesor"]==$datos_linea[0])
             {
                 $options.="<option selected value='".$datos_linea[0]."'>".$datos_linea[0]."</option>";
                 $nombre_profesor=$datos_linea[0];
                 for($i=1;$i<count($datos_linea);$i+=3)
                 {
                     if(isset($horario_profe[$datos_linea[$i]][$datos_linea[$i+1]]))
                         $horario_profe[$datos_linea[$i]][$datos_linea[$i+1]].="/".$datos_linea[$i+2];
                     else
                         $horario_profe[$datos_linea[$i]][$datos_linea[$i+1]]=$datos_linea[$i+2];
                 }
         
             }
             else
                 $options.="<option value='".$datos_linea[0]."'>".$datos_linea[0]."</option>";
        }




        fclose($fd); //como he sigo capaz de abrirlo lo close
        //si lo muevo y le doi los permisos me lo va a leer
    ?>
        <h2>Horario de los profesores</h2>
        <!--cojo primer dato de cada una de las lineas, tengo abierto el fichero, debo recorrerlo y antes de cerrar
el php de arriba, lo recojo en un array.-->

        <form action="ejercicio4SolProf.php" method="post" enctype="multipart/form-data">

            <p>
                <label for="profesor">Horario del profesor</label>
                <select name="profesor" id="profesor">


                    <?php
                    
                    echo $options;
                    ?>
                </select>
                <button type="submit" name="btnVerHorario">Ver Horario</button>
                <label for="prueba">prueba</label>
            </p>

        </form>

        <?php

        if (isset($_POST["btnVerHorario"])) {
           

           echo "<h3 class='text_centrado'>Horario del Profesor: ".$nombre_profesor."</h3>";

            $horas[1]="8:15-9:15";
            $horas[]="9:15-10:15";
            $horas[]="10:15-11:15";
            $horas[]="11:15-11:45";
            $horas[]="11:45-12:45";
            $horas[]="12:45-13:45";
            $horas[]="13:45-14:45";
        
            echo "<table>";
            echo "<tr><th></th><th>Lunes</th><th>Martes</th><th>Miércoles</th><th>Jueves</th><th>Viernes</th></tr>";
            for($hora=1;$hora<=7;$hora++)
            {
                echo "<tr>";
                echo "<th>".$horas[$hora]."</th>";
                if($hora==4)
                {
                    echo "<td colspan='5'>RECREO</td>";
                }
                else
                {
                    for($dia=1;$dia<=5;$dia++)
                    {
                        if(isset($horario_profe[$dia][$hora]))
                        {
                            echo "<td>".$horario_profe[$dia][$hora]."</td>";
                        }
                        else
                        {
                            echo "<td></td>";
                        }
                    } 
                }
                echo "</tr>";
            }
            echo "</table>";
        
        
          



        }
    } else { //si no open
        ?>
        <h2>No se encuentra el archivo <em>Horario/horarios.txt</em></h2>
        <form action="ejercicio4SolProf.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="fichero">Incluye un fichero Max 1MB</label>

            </p>
            <p>
                <input type="file" name="fichero" id="fichero" accept=".txt" />
                <?php
                if (isset($_POST["btnSubir"]) && $error_form) {
                    if ($_FILES["fichero"]["name"] == "")
                        echo "<span class='error'>Vacío***No has subido nada</span>";
                    else if ($_FILES["fichero"]["error"])
                        echo "<span class='error'>No se ha podido subir el fichero al servidor</span>";
                    else if ($_FILES["fichero"]["type"] != "text/plain")
                        echo "<span class='error'>No es un texto plano</span>";
                    else  echo "<span class='error'>Error de tamaño</span>";
                }
                ?>

            </p>

            <p>
                <button type="submit" name="btnSubir">Subir fichero</button>
            </p>

        </form>

    <?php
    }


    ?>








</body>

</html>