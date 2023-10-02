<!-- 
    I__1
    V__5
    X__10
    L__50
    C__100
    A__500
    M___1000

    primero controlar que metas las letras basicas
    segundo que las meta en el orden correcto
    tercera que no metra mas de 4 caracteres por  tipo  de número
-->
<?php
// si hay campos vacios envia el error
if (isset($_POST["convertir"])) {

    $textoPrimera = trim($_POST["numero"]);

    // tengo que controlar el tamaño de la palabra
    // lo mejor meterlo  en una variable y de hay generar los errores
    $error_numero_vacio = $textoPrimera == "";
    //aqui tengo que controlar que de cada uno de los número en romano no sea mayor de 4
   // $error_primeraPalabraTama = strlen($textoPrimera) < 3;


    $error_form =$error_numero_vacio || $error_primeraPalabraTama;
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
    <form action="eje4.php" method="post" enctype="multipar/form-data">
        <div class="palabras">
            <h1>Romanos a árabes-Formulario</h1>
            <p>Dime un número en números romanos y lo convertire a cifras árabes</p>
            <p>
                <label for="numero">Número: </label>
                <input type="text" name="numero" id="n1" value="<?php if (isset($_POST["numero"])) echo $_POST["numero"] ?>">
                <?php
                if (isset($_POST["convertir"]) &&$error_numero_vacio)   echo "<span class='error'>*Campo Obligatorio* </span>";
               // else if (isset($_POST["convertir"]) && $error_primeraPalabraTama) echo "<span class='error'>*La palabra tiene que tener 3 caracteres como mínimo* </span>";
                ?>
            </p>

            <p>
                <button type="submit" name="convertir">Convertir</button>
            </p>
        </div>
    </form>
    <?php
    // si se le da ha comparar y no hay errores
    if (isset($_POST["convertir"]) && !$error_form) {
    ?>
        <br>
        <div class="verde">
            <h1>Romanos a árabes-Resultado</h1>
            <?php

            $frase_con_ma = strtoupper($_POST["numero"]);



            function quitarEspacios($frase)
            {
                $res = ""; //genero un string
                for ($i = 0; $i < strlen($frase); $i++) {
                    if ($frase[$i] != " ") {
                        $res .= $frase[$i]; // concateno los resultados al string OJO SE CONCATENA CON EL .=
                    }
                }
                return $res;
            }
            $texto = quitarEspacios($frase_con_ma);
            $i = 0; //valor hacia delante
            $j = strlen($texto) - 1; // ultimo valor del indice del array
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

                echo "<p>La frase " . $_POST["numero"] . " es palíndroma</p>";
            } else {
                echo "<p>La frase " . $_POST["numero"] . " No  es palíndroma</p>";
            }



            ?>

        </div>
    <?php
    }
    ?>
</body>

</html>