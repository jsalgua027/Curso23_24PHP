<<?php
if (isset($_POST["comprobar"])) {
    $erro_form = $_POST["frase"] == "";
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
    <h1>Contar palabras sin las vocales (a, e ,i ,o u)</h1>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="frase">Escriba una frase</label>
            <input type="text" name="frase" id="frase" value="<?php if (isset($_POST["frase"])) echo $_POST["frase"] ?>">
        </p>
        <p>
            <label for="separador">Elija el separador</label>
            <select name="separacion" id="separacion">
                <!-- mantengo los campos, si existe el boton y el value de la opcion me pones selected-->
                <option <?php if (isset($_POST["comprobar"]) && $_POST["separacion"] == ",") echo "selected" ?> value=",">,</option>
                <option <?php if (isset($_POST["comprobar"]) && $_POST["separacion"] == ";") echo "selected" ?> value=";">;</option>
                <option <?php if (isset($_POST["comprobar"]) && $_POST["separacion"] == " ") echo "selected" ?> value=" ">espacio</option>
                <option <?php if (isset($_POST["comprobar"]) && $_POST["separacion"] == ":") echo "selected" ?> value=":">:</option>

            </select>
        </p>
        <button type="submit" name="comprobar">Comprobar</button>
        <?php
        if (isset($_POST["comprobar"]) && $erro_form) {
            echo "<p class='error'>El campo esta vacio</p>";
        }


        ?>
    </form>
    <?php
    if (isset($_POST["comprobar"]) && !$erro_form) {
        $palabras_por_separador=ExplodeMA($_POST["frase"],$_POST["separacion"]);
        $palabras_sin_vocales=filtrar_sin_vocales($palabras_por_separador);
       
        
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

        function filtrar_sin_vocales($arr_palabras){
            $respuesta=[];
            for($i=0; $i<count($arr_palabras);$i++)
            {
                if(!tiene_vocales($arr_palabras[$i]))
                    $respuesta=$arr_palabras[$i];
            }
            return $respuesta;
        }


        function tiene_vocales($palabra){

            $tiene=false;
            //array asociativo y con isset le pregunto
            $vocales["a"]=1; 
            $vocales["A"]=1; 
            $vocales["e"]=1; 
            $vocales["E"]=1; 
            $vocales["i"]=1; 
            $vocales["I"]=1; 
            $vocales["o"]=1; 
            $vocales["O"]=1; 
            $vocales["u"]=1; 
            $vocales["U"]=1; 
        
        
            for ($i=0; $i <strlen($palabra) ; $i++) { 
        
                if(isset($vocales[$palabra[$i]])){
                    $tiene=true;
                    break;
                }
            }
        
            return $tiene;
        }

        //OJO FALTA TERMINAR EL ECHO
       // echo "<p>El número de palabras separadas por el separador es de : " . count(explodeMA( $_POST["frase"],$_POST["separacion"])) . "</p>";
    }


    ?>

</body>

</html>