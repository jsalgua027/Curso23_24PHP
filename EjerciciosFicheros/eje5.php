<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,td , th{border: 1px solid black;}
        table{border-collapse: collapse; width: 90%; margin: 0 auto;}


    </style>
</head>

<body>
    <table>
        <?php
        $fd = fopen("http://dwese.icarosproject.com/PHP/datos_ficheros.txt", "r");
        if (!$fd) {

            die("<p>No se ha podido abrir el fichero: http://dwese.icarosproject.com/PHP/datos_ficheros.txt </p>");
        }
        echo"<caption> PIB oer cápita  de los paises de la Unión Europea </caption>";
       
        $linea=fgets($fd);
        $datos_linea=explode("\t",$linea);
        $n_columnas=count($datos_linea);
        
        echo"<tr>";
        for ($i=0; $i <$n_columnas ; $i++) { 
            echo"<th>".$datos_linea[$i]."</th>";
        }

        echo "</tr>";

        while($linea=fgets($fd) ){
            $datos_linea=explode("\t",$linea);
            echo"<tr>";
            echo "<th>".$datos_linea[0]."</th>";

            for ($i=1; $i <$n_columnas ; $i++) { 
                if(isset($datos_linea[$i])){

                    echo"<td>".$datos_linea[$i]."</td>";
                }else{

                    echo"<td></td>";
                }


            }
            echo "</tr>";

        }
       
        fclose($fd);

        ?>

    </table>


</body>

</html>