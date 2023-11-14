<?php
// letra del dni
function LetraNIF($dni)
{
    $valor = (int) ($dni / 23);
    $valor *= 23;
    $valor = $dni - $valor;
    $letras = "TRWAGMYFPDXBNJZSQVHLCKEO";
    $letraNif = substr($letras, $valor, 1);
    return $letraNif;
}

//  dni bien escrito: cuando sea de nueve caracteres de numeros y el otro una letra
function dni_bien_escrito($texto)
{
    // devolvemos si tienen nueve caracteres,si los nueve primeros son números y la ultima letra este entre la A y la Z
    return strlen($texto) == 9 && is_numeric(substr($texto, 0, 8)) && substr($texto, -1) >= "A" && substr($texto, -1) <= "Z";
}

function dni_valido($texto)
{
    $numero = substr($texto, 0, 8);
    $letra = substr($texto, -1);
    $valido = LetraNIF($numero) == $letra;
    return $valido;
    // otra forma de hacelor  return LetraNIF(substr($texto, 0, 8)) == substr($texto, -1);
}



function repetido_variable($conexion, $tabla, $columna, $valor, $columna_clave = null, $valor_clave = null)
{
    //REALIZO LA CONSULTA
    try {
        if (isset($columna_clave)) {
            $consulta = "select * from " . $tabla . " where " . $columna . "='" . $valor . "' AND " . $columna_clave . "<>'" . $valor_clave . "'";
        } else {
            $consulta = "select * from " . $tabla . " where " . $columna . "='" . $valor . "'";
        }

        $resultado = mysqli_query($conexion, $consulta);
        $respuesta = mysqli_num_rows($resultado) > 0;
        mysqli_free_result($resultado);
    } catch (Exception $e) {
        mysqli_close($conexion);
        $respuesta = error_page("Práctica 1º CRUD", "<h1>Práctica 1º CRUD</h1><p>No se ha podido hacer la consulta: " . $e->getMessage() . "</p>");
    }
    return $respuesta;
}

function error_page($title, $body)
{
    $page = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $title . '</title>
    </head>
    <body>' . $body . '</body>
    </html>';
    return $page;
}
