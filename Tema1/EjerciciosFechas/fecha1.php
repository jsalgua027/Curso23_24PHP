<?php

function buenos_separadores($texto){

    return substr($texto, 2, 1) == "/" && substr($texto, 5, 1) == "/";

}

function numeros_buenos($texto){
  return is_numeric(substr($texto,0,2)) && is_numeric(substr($texto,3,2)) && is_numeric(substr($texto,6,4));
    
}

function fecha_valida($texto){
return checkdate(substr($texto,3,2),substr($texto,0,2),substr($texto,6,2));

}

// si hay campos vacios envia el error
if (isset($_POST["calcular"])) {

    
    
    //errores de fec1
  
   
  
    $error_fecha1 =  $_POST["fecha1"] == "" || strlen($_POST["fecha1"]) != 10 ||!buenos_separadores($_POST["fecha1"]) || !numeros_buenos($_POST["fecha1"]) || !fecha_valida($_POST["fecha1"]);
    //errores de fec2
    
   
 
   
    $error_fecha2 = $_POST["fecha2"] == "" || strlen($_POST["fecha2"]) != 10  || !buenos_separadores($_POST["fecha2"]) ||  !numeros_buenos($_POST["fecha2"]) || !fecha_valida($_POST["fecha2"]);
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
        
-->
    <form action="fecha1.php" method="post" enctype="multipar/form-data">
        <div class="fechas">
            <h1>Fecha-Formulario</h1>
            <p> cálculo de la diferencias de días entres dos fechas dadas.</p>
            <p>
                <label for="fecha1">Introduce una fecha:(DD/MM/YYYY)</label>
                <input type="text" name="fecha1" id="fecha1" value="<?php if (isset($_POST["fecha1"])) echo $_POST["fecha1"] ?>">
                <?php
                if (isset($_POST["calcular"]) &&  $error_fecha1 ){
                    if($_POST["fecha1"]==""){

                        echo "<span class='error'>*Campo vacio* </span>";
                    }else{
                        echo "<span class='error'>*Fecha no validad* </span>";
                        }
                  

                }   
               
                ?>
            </p>
            <p>
                <label for="fecha2">Introduce una fecha:(DD/MM/YYYY)</label>
                <!--En el value controlo que deje la informacion correcta -->
                <input type="text" name="fecha2" id="fecha2" value="<?php if (isset($_POST["fecha2"])) echo $_POST["fecha2"] ?>">
                <!--Dentro del <p> controlo el error del campo vacio con mensaje de error -->
                <?php
                if (isset($_POST["calcular"]) &&  $error_fecha2 ){
                    if($_POST["fecha2"]==""){

                        echo "<span class='error'>*Campo vacio* </span>";
                    }else{
                        echo "<span class='error'>*Fecha no validad* </span>";
                        }
                  

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
    if (isset($_POST["calcular"]) && !$error_form) {
    ?>
        <br>
        <div class="verde">
            <h1>Ripios_Resultados</h1>
            <?php

             
             
                // resuelvo
                $array_fecha1=explode("/",$_POST["fecha1"]);
                $array_fecha2=explode("/",$_POST["fecha2"]);

                //una forma-------------> la comentada mejor
                //$tiempo1=mktime(0,0,0, $array_fecha1[1], $array_fecha1[0], $array_fecha1[2]);
                //$tiempo2=mktime(0,0,0, $array_fecha2[1], $array_fecha2[0], $array_fecha2[2]);
                // la otra forma
                $tiempo1=strtotime($array_fecha1[2]."/".$array_fecha1[1]."/".$array_fecha1[0]);
                $tiempo2=strtotime($array_fecha2[2]."/".$array_fecha2[1]."/".$array_fecha2[0]);
                       
                $dif_segundos=abs($tiempo1-$tiempo2);

                $dias_pasados=floor($dif_segundos/(60*60*24));
                
                echo "<p>La diferencia en días entre las dos fechas es: ".$dias_pasados."</p>";


            ?>

        </div>
    <?php
    }
    ?>
</body>

</html>