<?php

//maximo de numeros que se pueden desplazar en el encriptado
define("LETRASABECEDARIO",  ord("Z") - ord("A"));

function encriptar($texto, $desplazamiento)
{
    $mensajeEncriptado = "";

    for ($i = 0; $i < strlen($texto); $i++) {
        if (ord($texto[$i]) >= ord("A") && ord($texto[$i]) <= ord("Z")) {
            if (ord($texto[$i]) + $desplazamiento > ord("Z")) {
                //- todas las treas - 1 por que letrasabecedario es la resta desde al z hasta la a, no es la longitud entera
                $mensajeEncriptado .= chr(ord($texto[$i]) + $desplazamiento - LETRASABECEDARIO - 1);
            } else {
                $mensajeEncriptado .= chr(ord($texto[$i]) + $desplazamiento);
            }
        } else {
            $mensajeEncriptado .= $texto[$i];
        }
    }

    return $mensajeEncriptado;
}

function isSubcadena($texto, $cadenaABuscar)
{
	for ($i = 0; $i <= strlen($texto) - strlen($cadenaABuscar); $i++) {

		$igual = false; //lo inicializo a false

		if ($texto[$i] == $cadenaABuscar[0]) { //si ambas son iguales, es candidata
			$igual = true;

			for ($j = 0; $j < strlen($cadenaABuscar); $j++) { //recorremos la longitud de la palabra
				//si son iguales no pasara nada
				if ($texto[$i + $j] != $cadenaABuscar[$j]) {
					//si salta que son diferentes las letrtas comprobadas, salta "false" y termina el bucle
					$igual = false;
					break;
				}
			}
		}
		//cuando termian el bucle, si todo a sidop igual sera true, por lo tanto terminara el for principal
		if ($igual) return true;

		//ultima posicion donde podemos buscar, si no ha salido del bucle, significa que no es subcadena
		if ($i == strlen($texto) - strlen($cadenaABuscar)) return false;

		//sino vuelta a empezar hasta que termine el texto
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejrcicio 3</h1>
    <?php
    $texto = file_get_contents("codificado.txt");
    
    $felix = "FELIX";

    $desplazamiento = 0;

    for ($i=1; $i <= 25; $i++) { 
        
        if (isSubcadena(encriptar($texto, $i), $felix)) {
            $desplazamiento = $i;
            break;
        }
    }

    @$fd = fopen("desencriptado.txt", "w");
    if ($fd) {
        die ("No se ha podido generar el archivo");
    }

    while ($fila == fgets($fd)) {
        # code...
    }

    fclose($fd);
    ?>
</body>
</html>