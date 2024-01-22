<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación Web de prueba Ejercicio uno API REST</title>
</head>

<body>
    <?php

    define("DIR_SERV", "http://localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/ServiciosWeb/Ejercicio1/servicios_rest");
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

    $datos["cod"] = "YYYY";
    $datos["nombre"] = "producto a borrar";
    $datos["nombre_corto"] = "productoInse";
    $datos["descripcion"] = "descirpcion a borrar";
    $datos["PVP"] = 29.3;
    $datos["familia"] = "MP3";

    $url = DIR_SERV . "/producto/insertar";
    $respuesta = consumir_servicios_REST($url, "POST", $datos);
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error cconsumiendo el servicio: " . $url . "</p>" . $respuesta);
    }
    if (isset($obj->mensaje_error)) {
        die("<p>" . $obj->mensaje_error . "</p></body></html>");
    }
    echo "<p>" . $obj->mensaje_error . "</p>";

    ?>

</body>

</html>