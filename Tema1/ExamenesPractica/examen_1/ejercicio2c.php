<?php
if (isset($_POST["contar"])) {
    // solo hay error si no escribe nada
    // me aseguro que el texto no tenga espacios al principio y al final 
    $texto = trim($_POST["texto"]);
    $error_form = $texto == "";
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

            color: red
        }
    </style>
</head>

<body>
    <form action="ejercicio2.php" method="post" enctype="multipart/form-data">
        <h1>Ejercicio 2. Contar Palabras sin las vocales (a,e,i,o,u,A,E,I,o,U)</h1>

        <p><label for="texti">introduce un Texto</label>
            <input type="text" id="texto" name="texto" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"] ?>">
            <?php
            if (isset($_POST["contar"]) && $error_form) {

                echo "<p class=error>El campo esta Vacio </p>";
            }


            ?>
        </p>
        <p><label for="sep">Elija el separador</label>
            <select name="sep" id="sep">
                <option value=",">Coma</option>
                <option value=";">Punto y Coma</option>
                <option value=" ">Espacio</option>
                <option value=":">Dos Puntos</option>
            </select>

        </p>
        <button type="submit" name="contar">Contar</button>

    </form>
    <?php
    if (isset($_POST["contar"]) && !$error_form) {

        echo "<h1>Respuesta</h1>";

        $sep = $_POST["sep"];
        $texto = trim($_POST["texto"]);
        $vocalesNoMay="ÁÉÍÓÚ";
        $vocalesNomin="áéíóú";
        $contador=0;
       
       
        function contadorPalbaras($tex, $separador)
        {
            $pala="";
            $arrPalabras=[];
            $fin=strlen($tex);
            for ($i = 0; $i < strlen($tex); $i++) {

                if ($tex[0] != $separador && $tex[$fin]-1 != $separador) {
                    $i++;
                    $pala.+$tex[$i];
                    if($tex[$i]==$separador){
                        $pala.array_push($arrPalabras);
                    }
                }
            }
            return count($arrPalabras);
       }


       $resultado=contadorPalbaras($texto,$sep);
       

       
       $resultado=strlen($texto);
       echo $resultado;


    }

    ?>

</body>

</html>