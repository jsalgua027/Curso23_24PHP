<?php
// si hay campos vacios envia el error
if (isset($_POST["comprobar"])) {

    $textoPrimera = trim($_POST["frase"]);

    // tengo que controlar el tamaño de la palabra
    // lo mejor meterlo  en una variable y de hay generar los errores
    $error_primeraPalabra = $textoPrimera == "";

    $error_primeraPalabraTama = strlen($textoPrimera) < 3;


    $error_form = $error_primeraPalabra || $error_primeraPalabraTama;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .palabras {
            background-color: #D8EDF2;
            border: 2px solid black;
        }

        button {
            background-color: grey;
        }

        .verde {
            background-color: #D8F2D8;
            border: 2px solid black;
        }
    </style>
</head>

<body>
    <!--
     Escribe un formulario que pida una palabra o número y te diga si es o no un
palíndromo o un número capicúa:
        
-->
    <form action="eje3.php" method="post" enctype="multipar/form-data">
        <div class="palabras">
            <h1>Frases palíndromas - Formulario</h1>
            <p>Dime una frase te dire si es un palíndorma</p>
            <p>
                <label for="frase">Frase: </label>
                <input type="text" name="frase" id="g1" value="<?php if (isset($_POST["frase"])) echo $_POST["frase"] ?>">
                <?php
                if (isset($_POST["comprobar"]) && $error_primeraPalabra)   echo "<span class='error'>*Campo Obligatorio* </span>";
                else if (isset($_POST["comprobar"]) && $error_primeraPalabraTama) echo "<span class='error'>*La palabra tiene que tener 3 caracteres como mínimo* </span>";
                ?>
            </p>

            <p>
                <button type="submit" name="comprobar">Comprobar</button>
            </p>
        </div>
    </form>
    <?php
    // si se le da ha comparar y no hay errores
    if (isset($_POST["comprobar"]) && !$error_form) {
    ?>
        <br>
        <div class="verde">
            <h1>Palíndromos / capícuas-Resultado</h1>
            <?php
            
            $frase_con_ma = strtoupper($_POST["frase"]);

            

            function quitarEspacios($frase)
            {
                $res=""; //genero un string
                for ($i = 0; $i < strlen($frase); $i++) {
                    if ($frase[$i] != " ") {
                       $res.=$frase[$i]; // concateno los resultados al string OJO SE CONCATENA CON EL .=
                    }
                }
                return $res;
            }
            $texto = quitarEspacios($frase_con_ma);
            $i = 0; //valor hacia delante
            $j = strlen($texto) -1; // ultimo valor del indice del array
            $bien = true;

            while ($i < $j && $bien) {

                if ($texto[$i] == $texto[$j]) {
                    $i++;
                    $j--;
                } else {
                    $bien = false;
                }
            }

            if ($bien) {

                echo "<p>La frase " . $_POST["frase"] . " es palíndroma</p>";
            } else {
                echo "<p>La frase " . $_POST["frase"] . " No  es palíndroma</p>";
            }



            ?>

        </div>
    <?php
    }
    ?>
</body>

</html>