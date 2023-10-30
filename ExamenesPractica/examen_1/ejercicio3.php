<?php
    if(isset($_POST["generar"])){

        $error_texto=$_POST["texto"]=="";
        $error_despl=$_POST["despl"]=="" || !is_numeric($_POST["despl"])|| $_POST["despl"]<1||$_POST["despl"]>26 ;
        $error_archivos=$_FILES["archivo"]["name"]=""||$_FILES["archivo"]["error"]||$_FILES["archivo"]["typw"]!="text/plain"|| $_FILES["archivo"]["size"]> 1250*1024;

        $error_form=$error_texto||$error_despl|| $error_archivos;

    }

    function explodeMA($texto, $sepa)
    {
        $aux = [];
        $longitud = strlen($texto);
        $i = 0;

        while ($i < $longitud && $texto[$i] != $sepa)
            $i++;

        if ($i < $longitud) {
            $j = 0;
            $aux[$j] = $texto[$i];
            for ($i = $i + 1; $i < $longitud; $i++) {
                if ($texto[$i] != $sepa) {
                    $aux[$j] .= $texto[$i];
                } else {
                    while ($i < $longitud && $texto[$i] == $sepa)
                        $i++;

                    if ($i < $longitud) {
                        $j++;
                        $aux[$j] = $texto[$i];
                    }
                }
            }
        }
        return $aux;
    }


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {

            color: red;
        }
    </style>
</head>

<body>
    <h1>Ejercicio 3. codifica la frase</h1>
    <form action="ejercicio3.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="frase">Escriba una tetxo</label>
            <input type="text" name="texto" id="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"] ?>">

            <?php
                if(isset($_POST["generar"])&& $error_texto){
                    
                    if($_POST["texto"]=="")
                    
                    echo "<span class='error'> Campo vacio</span>";
                    else{


                    }

                }
            
            // faltan errores
            
            ?>


        </p>

        <p>
            <label for="frase">Escriba un desplazamiento</label>
            <input type="text" name="despl" id="despl" value="<?php if (isset($_POST["despl"])) echo $_POST["despl"] ?>">
            <?php
            
            //los errores
            
            ?>

        </p>

        <p>

            <label for="archivo">Seleccione el archivo de claves(.txt y menor 1.25 MB)</label>
            <input type="file" name="archivo" accept=".txt">
            <?php
            
            //los errores
            
            ?>

        </p>
        <p>

            <button name="generar" type="submit">Gnerar</button>
        </p>
    </form>


               <?php 
               
               if (isset($_POST["generar"])&& !$error_form) {
                
                 echo"<h>Respuesta</h1>";

                 @$fd=fopen($_FILES["archivos"]["tmp_name"],"r");

                 if(!$fd){
                    die("<p> NO se ha podido abrir el fichero</p>");

                 }
                 $primera_linea=fgets($fd);
                 while ($linea=fgets($fd)) {
                    $datos_linea=ExplodeMA(";",$linea);
                    $claves[$datos_linea[0]]=$datos_linea;
                 }

                 fclose($fd);
                 $respuesta="";
                 $texto=$_POST["texto"];
                 $despla=$_POST["despl"];

                 for ($i=0; $i <strlen($texto) ; $i++) { 
                    if($texto[$i]>="A" && $texto[$i]<="Z" ){
                        $respuesta.=$claves[$texto[$i]][$despl];
                    }else{
                        $respuesta.=$texto[$i];
                    }
                }
                echo"<p>El texto codificado seria:<br>".$respuesta."</p>";
            }
               
               
               ?> 



</body>

</html>