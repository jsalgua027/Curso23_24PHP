<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio3</h1>

    <?php
        $mesPeli["Enero"]=9;
        $mesPeli["Febrero"]=12;
        $mesPeli["Marzo"]=0;
        $mesPeli["Abril"]=17;

        foreach ($mesPeli as $mes => $valores) {
            if($valores==0){

                echo "<p> El mes: ".$mes." no he visto nunguna peli<p/><br/>";

            }else{

                echo "<p> El mes: ".$mes." he visto: ".$valores." pelis<p/> <br/>";
            }
        }
    
    
    
    
    ?>

</body>
</html>