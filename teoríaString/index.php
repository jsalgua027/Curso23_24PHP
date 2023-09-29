<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría String</title>
</head>
<body>
    <?php 
     $str1="       hola que tal?"; 
     $nuevo_str1=trim($str1);// quita espacios
     $str2="juan"; 
        echo "<h1>".$str1." ".$str2."</h1>";

        // me da la lingitud de un string

        $longitud=strlen($str2); // metodo grabado a fuego

        echo "<p>La longitud del String: ".$str1." es: ".$longitud."</p>";
        // asignar un carcater del string $str1 a la variable $a !!esto nos avisa que podemos acceder a cualquier parte del string
        $a= $str1[3];

        $str1[12]="!"; // cambiamos el valor de esa posicion
        echo "<h1>".$str1."</h1>";

        echo "<h1>".strtoupper($str2)."</h1>";// mayusculas

        echo "<h1>".strtolower($str2)."</h1>";// minusculas
       // separa como queramos......como el metodo split de java !!!! Lo vamos a usar bastante
        $prueba="Hola mi nombre es nacho salcedo";
        $sep_arr=explode(" ",$prueba);
        print_r($sep_arr);
        echo "<br/>";
        $prueba2="Hola mi nombre es: nacho salcedo";
        $sep_arr=explode(":",$prueba2);
        print_r($sep_arr);
        echo "<br/>";

        //la funcion inversa del explode
        $arr_prueba=array("hola","Juan", "Antonio",12,"Maria");
        print_r($arr_prueba);
        $str3=implode(":::",$arr_prueba);

        echo "<p>".$str3."</p>";
        echo "<br/>";
        //ponte en la posicion 0 y dame 5 caracteres se puede usar solo un número y comienza desde 0, se los das negativos y es desde el final
        echo "<p>".substr("hola que tal, juan",0,5)."</p>";

    ?>
   



</body>
</html>