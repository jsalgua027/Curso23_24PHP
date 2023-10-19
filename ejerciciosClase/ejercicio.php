<?php
    if (isset($_POST["comprobar"])) {

        $l_texto=strlen($_POST["palabra"]);
        $error_form=$_POST["palabra"]==""||$l_texto<2;
        
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--formulario, meta una palabra y te diga "si se repiten caracteres" o "o no se repiten caracteres" lo se puede usar srtlen;    -->

    <form action="ejercicio.php" method="post" enctype="multipart/form-data">
        <label for="palabra">Inidica una palabra, vamos a ver si se repiten los caracteres</label>
        <input type="text" name="palabra" id="palabra">
        <?php
             if (isset($_POST["comprobar"])&& $error_form) {
                echo"<p>No has introducicdo ningun campo</p>";
               
                
            }
        
        
        ?>
        
        <button type="submit" name="comprobar">Comprobar</button>
    </form>
    
    <?php
             if (isset($_POST["comprobar"])&& !$error_form) {
               
                $palabra=$_POST["palabra"];
                $contador=0;
                for ($i=0; $i <strlen($palabra) ; $i++) { 
                    for ($j=$i+1; $j <strlen($palabra) ; $j++) { 
                        if($palabra[$i]==$palabra[$j]){
                            $contador++;
                            break;

                        }
                        if($j<$i){
                            break;
                        }
                    
                    }   
                }
                if ($contador!=0){

                    echo "<p>Se repiten</p>";
                }else{

                    echo "<p>Se NO repiten      </p>";
                }
               
               
                
            }
        
        
        ?>
        
    
</body>
</html>