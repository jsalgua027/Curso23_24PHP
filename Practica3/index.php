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


$error_form = false;

if (isset($_POST["guardar"])) { // compruebo errores

    $error_nombre = $_POST["nombre"] == "";
    $error_apellidos = $_POST["apellidos"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
    $error_sexo = !isset($_POST["sexo"]); // si no existe 
    $error_comentarios = $_POST["comentarios"] == "";

    $error_form = $error_nombre || $error_apellidos || $error_clave || $error_sexo || $error_comentarios || $error_dni;
}

if (isset($_POST["guardar"]) && !$error_form) {


    require "vistas/vistas_respuestas.php";
} else {



    require "vistas/vistas_formulario.php";
}
