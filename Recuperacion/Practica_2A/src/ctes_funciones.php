<?php


/* CONEXION A lA BASE DE DATOS*/
define("SERVIDOR_BD","localhost");
define("USUARIO_BD","jose");
define("CLAVE_BD","josefa");
define("NOMBRE_BD","bd_rec_cv");
define("MINUTOS",5);
define("FOTO_DEFECTO","no_imagen.jpg");// constante para la logica de no poder borrar esa imgen por defecto




function error_page($title,$body)
{
    $page='<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>'.$title.'</title>
    </head>
    <body>'.$body.'</body>
    </html>';
    return $page;
}
// funcion que te dice la letra del dni en mayuscula
function LetraNIF($dni)
{
    return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
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



// esta función repetido es con mysql

function repetido($conexion, $tabla, $columna, $valor, $columna_clave = null, $valor_clave = null)
{


    try {
        if (isset($columna_clave)) {
            $consulta = "select * from " . $tabla . " where " . $columna . "=? AND " . $columna_clave . "<>?";
            $datos = [$valor, $valor_clave];
        } else {
            $consulta = "select * from " . $tabla . " where " . $columna . "=?";
            $datos = [$valor];
        }

        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);
        $respuesta = $sentencia->rowCount() > 0;
    } catch (PDOException $e) {
        $respuesta = $e->getMessage();
    }

    $sentencia = null;


    return $respuesta;
}







?>

