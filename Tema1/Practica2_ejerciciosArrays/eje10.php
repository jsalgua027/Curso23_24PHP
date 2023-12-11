<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Ejercicio 10</h1>
    <?php
    $numero = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    $contadorNumerosParesValorTotal = 0;
    $mediaNumerosPares = 0;
    $cantidadNumeros = 0;
    
    for ($i=0; $i <count($numero) ; $i++) {
        if($i%2==0){
            $contadorNumerosParesValorTotal+=$numero[$i];
            $cantidadNumeros++;
        } if($numero[$i] %2!=0) {

            echo "<p>El : " . $numero[$i]. " es impar</p>";
        }
}
$mediaNumerosPares=$contadorNumerosParesValorTotal/$cantidadNumeros;

echo "<p>La media de los números de las posiciones pares es: " . $mediaNumerosPares;

 
/*
    foreach ($numero as $i =>$num) {
        if ($i % 2 == 0) {
            $contadorNumerosParesValorTotal += $num;
            $cantidadNumeros++;
        } if($num %2!=0) {

            echo "<p>El : " . $num . " es impar</p>";
        }
    }
    $mediaNumerosPares = $contadorNumerosParesValorTotal / $cantidadNumeros;

    echo "<p>La media de los números de las posiciones pares es: " . $mediaNumerosPares;
*/
    ?>
</body>

</html>