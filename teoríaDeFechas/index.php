<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría de fechas</title>
</head>
<body>
    <h1>Teoría de Fechas</h1>
    <?php
        echo "<p>".time()."</p>";
        //date funciona con uno o con dos argumentos
        echo "<p>Dia de hoy</p>";
        echo "<p>".date("d/m/y")."</p>";

        echo "<p>Dia de hoy con hora:minutos:segundos</p>";
        // se usa la i pq la m esta cogida para el mes
        echo "<p>".date("d/m/y h:i:s")."</p>";
        //devuelve true o false si existe esa fecha
        if(checkdate(2,29,2023)){

            echo "<p>Fecha buena</p>";
        }else{

            echo "<p>Fecha mala</p>";
        }

        //mktime(hora,minuto,seg,mes,dia,año) te genera los segundos que han  pasado desde la fecha que le pasas hasta la actual
        echo date("d/m/Y", mktime(0,0,0,9,23,1976));
        // te da los segundos que han pasado pero le pasamos la fecha por un string
         echo "<p>".strtotime("09/23/1976") ."</p>";

            // REDONDEAMOS
            // redondeamos abajo
            echo "<p>".floor(6.5) ."</p>";
            // redondeamos arriba
            echo "<p>".ceil(6.5) ."</p>";
            // el valor absoluto de una funcion
            echo "<p>".abs(-8) ."</p>";


         // print() y echo es lo mimo pero podemos usarlo asi
        // sacar dos decimales %.2f
         printf("<p>%.2f</p>",5.6666*7.8888);
        // generar un string a una variable
         $resultado=sprintf("<p>%.2f</p>",5.6666*7.8888);
         echo $resultado;
        
    
        // ejmplo suso

            for ($i=1; $i <=20 ; $i++) { 
                
                // para imprimir 01 02 03 03........donde solo hay un digito me pone los dos
                    echo"<p>".sprintf("%02d",$i)."</p>"; 
                
            
            }


    ?>
</body>
</html>