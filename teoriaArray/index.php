<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria de Array</title>
</head>

<body>
    <h1>Teoria arrays</h1>

    <?php

    /*
    
        $nota[0]=5;
        $nota[1]=8;
        $nota[2]=9;
        $nota[3]=15;
        $nota[4]=21; */


    /*

        ESTO ES LO MISMO
        $nota[]=5;
        $nota[]=8;
        $nota[]=9;
        $nota[]=15;
        $nota[]=21;
        
        
        
        */
    // genero el mismo array con esta funcion
    $nota = array(5, 8, 9, 15, 21);

    // $nota= array(0=>5,1=>8,2=>9,3=>15,4=>21); se puede indicar el indice de cada valor

    // para ver por el html, sirve para depurar. print_ solo vale para arrays
    print_r($nota);

    // esta es la forma correcta
    echo "<br>";
    var_dump($nota);
    /*
        $valor[0]=10;
        $valor[1]="hola";
        $valor[3]=true;
        $valor[4]=3.4;
        */

    $valor[] = 10;
    $valor[3] = "hola";
    $valor[] = true;
    $valor[] = 3.4;
    echo "<br>";


    var_dump($valor);


    echo "<h1>Recorrido de un array escalar con sus indices correlativos</h1>";

    for ($i = 0; $i < count($nota); $i++) {
        echo "<p>En la posición: " . $i . " Tiene el valor: " . $nota[$i] . "</p>";
    }


    echo "<h1>Recorrido de un array escalar  con sus indices NO correlativos</h1>";

    $valor[] = 10;
    $valor[99] = "hola";
    $valor[] = false;
    $valor[200] = 3.4;
    // OJO CON LOS BOOLEANOS: SI ES TRUE PONE UN 1 SI ES FALSE  NO PONE NADA
    foreach ($valor as $indice => $contenido) {
        echo "<p>En la posición: " . $indice . " Tiene el valor: " . $contenido . "</p>";
    }

    echo "<h1>Recorrido de un array asociativo </h1>";
    /*$notasPhp["Antonio"]=5;
        $notasPhp["Nacho"]=7;
        $notasPhp["Samu"]=8;
        $notasPhp["Pepe"]=10;
        $notasPhp["Cristina"]=12;

        // en este caso los nombre son el contenido
        foreach ($notasPhp as $indice => $contenido) {
            echo"<p>".$indice." Ha sacado: ". $contenido;
            
        }*/


    // array multi
    echo "<h1>Recorrido de un array multi</h1>";

    $notasPhp["Antonio"]["DWEC"] = 5;
    $notasPhp["Antonio"]["DWEW"] = 5;
    $notasPhp["Nacho"]["DWEW"] = 7;
    $notasPhp["Samu"]["DWEW"] = 8;
    $notasPhp["Pepe"]["DWEC"] = 10;
    $notasPhp["Cristina"]["DWEW"] = 9;
    $notasPhp["Pedro"]["DWEW"] = 4;
    $notasPhp["Vicky"]["DWEC"] = 7;

    foreach ($notasPhp as $nombre => $asignatura) {
        echo "<p>" . $nombre . "</ul>";

        foreach ($asignatura as $nombre_asig => $valor) {
            echo "<li>" . $nombre_asig . "=>" . $valor . "</li>";
        }
        echo "</ul></p>";
    }


    // Funciones predefinidas de arrays
    echo "<p> FUNCIONES PREDEFINIDAS DE UN ARRAY "."</p>";
    

    $capital= array("Castilla y leon"=>"Vallalodid", "Asturias"=>"Oviedo", "Aragón"=>"Zaragoza");
    echo "<p> el current de un array: ".current($capital)."</p>"; // DA EL VALOR EN EL QUE ESTOY
    echo "<p> el  key de un array: ".key($capital)."</p>"; // DA EL VALOR EN EL INDICE QUE ESTOY
    echo "<p> me voy al final "."</p>";
    
    echo "<p> el ultimo valor de un array: ".end($capital)."</p>"; // DA EL ULTIMO VALOR
    echo "<p> el ultimo valor de un array: ".current($capital)."</p>";
    echo "<p> el key de un array: ".key($capital)."</p>";
    echo "<p>  reset de un array: ".reset($capital)."</p>";// DA EL PRIMER VALOR

    echo "<p> me voy hacia delante "."</p>";
    echo "<p>  reset de un array: ".next($capital)."</p>";// DA EL VALOR DEL INDICE +1
    echo "<p>  retrocedo "."</p>";
    echo "<p>  reset de un array: ".prev($capital)."</p>";// DA EL VALOR DEL INDICE -1


    // UNA MANERA DE HACERLO SIN FOREACH---- EJEMPLO PERO NO ES NORMAL HACERLO
    echo "<p> me muevo con un while pero no es la forma adecuada "."</p>";
    while (current($capital)) {
        echo "<strong>".current($capital)."</strong><br/>";
        next($capital);
    }


    ?>
</body>

</html>