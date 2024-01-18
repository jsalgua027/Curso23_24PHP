<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría Servicios Web</title>
</head>

<body>
    <h1>Teoría de Servicios Web</h1>
    <?php
    /*  /*version B de metodo get versión facil*/
    define("DIR_SERV", "http://localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/ServiciosWeb/teoriaServiciosWeb/primera_api");
    //localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/ServiciosWeb/teoriaServiciosWeb/saludo--->ponemos /saludo para la url
    
    /*version definitiv*/
    function consumir_servicios_REST($url, $metodo, $datos = null)
    {
        $llamada = curl_init();
        curl_setopt($llamada, CURLOPT_URL, $url);
        curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
        if (isset($datos))
            curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
        $respuesta = curl_exec($llamada);
        curl_close($llamada);
        return $respuesta;
    }
    /*
     version B de metodo get versión facil
     $url=DIR_SERV."/saludo";
    $respuesta=file_get_contents($url);
    // obtengo la respuestas
    $obj=json_decode($respuesta);
    // si no encuentro respuesta muero
    if(!$obj){
        die("<p>Error consumiendo el servicio: ".$url."<p>".$respuesta);
    }
    echo"<p>El saludo recibido ha sido <strong>".$obj->mensaje."</strong></p>";  
    */
    /*version definitivo*/
    $url = DIR_SERV . "/saludo";
    $respuesta = consumir_servicios_REST($url, "GET"); //-->indicamos la url y el tipo de metodo
    $obj = json_decode($respuesta);
    // si no encuentro respuesta muero
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "<p>" . $respuesta);
    }
    echo "<p>El saludo recibido ha sido <strong>" . $obj->mensaje . "</strong></p>";

    ?>
</body>

</html>