<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <form action="ejercicio1.php" method="post" enctype="multipart/form-data">
        <p><h1>Ejercicio. Generador de "Claves_cesar.txt"</h1></p>
        <button type="submit" name="generar">Generar</button>
    </form>
    <?php
       if(isset($_POST["generar"])){

        @$fd= fopen("claves_cesa2.txt", "w");
        
        $abc="ABCDEFGHIJKLMÑOPQRSTXWZ";
        

        if($fd){
            $primera_linea="Letra/Desplamiento";
            $num="1";
            $letra;
            for ($i=ord("A"); $i <=ord("Z") ; $i++) { 
                
                $primera_linea.+chr($num);
            }
            
            echo $primera_linea;
            echo $num;

            




        }else{
            die("el archivo no existe");

        }



    
        echo"<h2>Respuesta</h2>";
        echo "<textarea name='area' id='area' cols='30' rows='10'></textarea>";

       }
         
    ?>
     
</body>
</html>