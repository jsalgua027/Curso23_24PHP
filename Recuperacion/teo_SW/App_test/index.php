<?php
function consumir_servicios_REST($url,$metodo,$datos=null)
{
    $llamada=curl_init();
    curl_setopt($llamada,CURLOPT_URL,$url);
    curl_setopt($llamada,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($llamada,CURLOPT_CUSTOMREQUEST,$metodo);
    if(isset($datos))
        curl_setopt($llamada,CURLOPT_POSTFIELDS,http_build_query($datos));
    $respuesta=curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}

define("DIR_SERV","http://localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/Recuperacion/teo_SW/primera_api");


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagia para probar API REST</title>
</head>
<body>

<h1>Página para probar primera API</h1>
<?php
// metodo GET
    $respuesta=consumir_servicios_REST("http://localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/Recuperacion/teo_SW/primera_api/saludo","GET"); // aqui no uso la constante

    $json= json_decode($respuesta,true);
    if(!$json)
    {
        die("<p>Error consumiendo el servicio REST</p></body></html>");
    }
    
    echo"<p>El saludo recivbido ha sido : ".$json["mensaje"]."</p>";


    $respuesta=consumir_servicios_REST(DIR_SERV."/saludo/Nacho","GET");// aqui uso la constante OJO con la BARRA (/)  mira la costante

    $json= json_decode($respuesta,true);
    if(!$json)
    {
        die("<p>Error consumiendo el servicio REST</p></body></html>");
    }
    
    echo"<p>El saludo recivbido ha sido : ".$json["mensaje"]."</p>";


    $respuesta=consumir_servicios_REST(DIR_SERV."/saludo/".urlencode("Nacho salcedo"),"GET");// se usa el urlencode porque la sepraracion no se la traga

    $json= json_decode($respuesta,true);
    if(!$json)
    {
        die("<p>Error consumiendo el servicio REST</p></body></html>");
    }
    
    echo"<p>El saludo recivbido ha sido : ".$json["mensaje"]."</p>";


    // METODO POST
    $datos_env["nombre"]="Maria Antonia";  // ojo el nombre del indice del array es el mismo al del metodo post !!!!
    $respuesta=consumir_servicios_REST(DIR_SERV."/saludo/".urlencode("Nacho salcedo"),"POST", $datos_env);// se usa el urlencode porque la sepraracion no se la traga

    $json= json_decode($respuesta,true);
    if(!$json)
    {
        die("<p>Error consumiendo el servicio REST</p></body></html>");
    }
    
    echo"<p>El saludo recivbido ha sido : ".$json["mensaje"]."</p>";

// METODO DELETE
$respuesta=consumir_servicios_REST(DIR_SERV."/borrar_saludo/7","DELETE");// aqui uso la constante OJO con la BARRA (/)  mira la costante

$json= json_decode($respuesta,true);
if(!$json)
{
    die("<p>Error consumiendo el servicio REST</p></body></html>");
}

echo"<p>El saludo recivbido ha sido : ".$json["mensaje"]."</p>";

// metodo PUT

$datos_env["nombre"]="antonio jose";
$respuesta=consumir_servicios_REST(DIR_SERV."/actualizar_saludo/7","PUT",$datos_env);// aqui uso la constante OJO con la BARRA (/)  mira la costante

$json= json_decode($respuesta,true);
if(!$json)
{
    die("<p>Error consumiendo el servicio REST</p></body></html>");
}

echo"<p>El saludo recivbido ha sido : ".$json["mensaje"]."</p>";




?>
    
</body>
</html>