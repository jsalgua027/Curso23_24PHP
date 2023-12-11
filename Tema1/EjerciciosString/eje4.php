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
    siempre la anotacion romana es de mas grande al mas chico 
-->
<?php
// defino un array para usar en los metodos
const VALOR = array("M" => 1000, "D" => 500, "C" => 100, "L" => 50, "X" => 10, "V" => 5, "I" => 1);
//compruebo las letras
function letras_bien($texto)
{
    $bien = true;
    for ($i = 0; $i < strlen($texto); $i++) {
        if (!isset(VALOR[$texto[$i]])) {
            $bien = false;
            break;
        }
    }
    return $bien;
}
// compruebo el orden

function orden_bueno($texto)
{
    $bien = true;
    for ($i = 0; $i < strlen($texto) - 1; $i++) {
        if (VALOR[$texto[$i]] < VALOR[$texto[$i + 1]]) {
            $bien = false;
            break;
        }
    }
    return $bien;
}

//compruebo que no hay mas de 4

function repite_bien($texto)
{

    $veces = array("I" => 4, "V" => 1, "X" => 4, "L" => 1, "C" => 4, "D" => 1, "M" => 4);

    $bien = true;

    for ($i = 0; $i < strlen($texto); $i++) {
        $veces[$texto[$i]]--;
        if ($veces[$texto[$i]] == -1) {
            $bien = false;
            break;
        }
    }
    return $bien;
}



function es_correcto_romano($texto)
{

    return letras_bien($texto) && orden_bueno($texto) && repite_bien($texto);
}


// si hay campos vacios envia el error
if (isset($_POST["convertir"])) {

    $texto = trim($_POST["numero"]); // le quito los espacios en blanco
    $texto_m = strtoupper($texto);
    // tengo que controlar el tamaño de la palabra
    // lo mejor meterlo  en una variable y de hay generar los errores
    $error_numero_vacio = $texto == "";
    //aqui tengo que controlar que de cada uno de los número en romano no sea mayor de 4
    // $error_primeraPalabraTama = strlen($textoPrimera) < 3;


    $error_form = $error_numero_vacio ||  !es_correcto_romano($texto_m);
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
                <input type="text" name="numero" id="n1" value="<?php if (isset($_POST["numero"])) echo $texto ?>">
                <?php
                if (isset($_POST["convertir"]) && $error_form) {

                    if ($texto == "") {
                        echo "<span class='error'>*Campo Obligatorio* </span>";
                    } else {

                        echo "<span class='error'>*No has metido el numero romano correcto* </span>";
                    }
                }

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
            //guardo la suma
            $res = 0;
            for ($i = 0; $i < strlen($texto_m); $i++) {

                $res += VALOR[$texto_m[$i]];
            }

            echo "<p>El número romano " . $texto_m . " en Arabe es: " . $res . "</p>"
            ?>

        </div>
    <?php
    }
    ?>
</body>

</html>