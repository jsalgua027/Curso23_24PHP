
<?php
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


// si le doy a borrar, borrame toda la pagina
if (isset($_POST["borrar"])) {
    unset($_POST);
    // otra forma de hacerlo el 
    /*
            header("Location:index.php");
            exit;
            */
}
?>