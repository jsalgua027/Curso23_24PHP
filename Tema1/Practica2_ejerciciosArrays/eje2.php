<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Ejercicio 2</h1>
    <?php
    $v[1] = 90;
    $v[30] = 7;
    $v['e'] = 90;
    $v['hola'] = 90;

    foreach ($v as $indice => $valor) {

        //  echo "El indice es : " .$indice. " Su valor =>".$valor."<br/>";

        if (is_numeric($indice)) {
            echo "El indice es : " . $indice . " Su valor =>" . $valor . "<br/>";
        } else {

            echo "El indice es : '" . $indice . "' Su valor =>" . $valor . "<br/>";
        }
    }
    ?>



</body>

</html>