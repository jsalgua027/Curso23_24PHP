<?php
$capital=$_REQUEST["capi"];
$tasaInteres=$_REQUEST["interes"];
$numMeses=$_REQUEST["plazos"];

$num1=(int)$capital;
$num2=(int)$tasaInteres;
$num3=(int)$numMeses;


function calcularCuotaMensual($cap, $int, $nMes) {
    // Convertir la tasa de interés a términos decimales
    $tasaInteresDecimal = $int / 100 / 12;

    // Calcular la cuota mensual usando la fórmula de amortización
    $cuotaMensual = $cap * ($tasaInteresDecimal * pow((1 + $tasaInteresDecimal), $nMes)) / (pow((1 + $tasaInteresDecimal), $nMes) - 1);

    return $cuotaMensual;
}

$resultado=calcularCuotaMensual($num,$num2,$num3);

echo  "$resultado";




?>