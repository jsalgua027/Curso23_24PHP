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

    /* $datos["cod"] = "YYYY";
    $datos["nombre"] = "producto a borrar";
    $datos["nombre_corto"] = "productoInse";
    $datos["descripcion"] = "descirpcion a borrar";
    $datos["PVP"] = 50;
    $datos["familia"] = "MP3";

    $url = DIR_SERV . "/producto/actualizar/".urlencode("YYYY");
    $respuesta = consumir_servicios_REST($url, "PUT", $datos);
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error cconsumiendo el servicio: " . $url . "</p>" . $respuesta);
    }
    if (isset($obj->mensaje_error)) {
        die("<p>" . $obj->mensaje_error . "</p></body></html>");
    }
   echo "<p>" . $obj->mensaje . "</p>";

    
 */
/* $url = DIR_SERV . "/producto/borrar/".urlencode("YYYY");
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }
    if (isset($obj->mensaje_error)) {
        die("<p>" . $obj->mensaje_error . "</p></body></html>");
    }
   echo "<p>" . $obj->mensaje. "</p>";
*/

    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url,"GET");
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }
    if (isset($obj->mensaje_error)) {
        die("<p>" . $obj->mensaje_error . "</p></body></html>");
    }
   


    echo"<table>";
    echo "<tr><th>Cod</th><th>Nombre corto</th></tr>";
     for ($i=0; $i<count($obj->productos) ; $i++) { 
        echo"<tr>";
        echo"<td>".$obj->productos[$i]->cod."</td>";
        echo"<td>".$obj->productos[$i]->nombre_corto."</td>";
        echo"</tr>";

     }

  /*   foreach($obj ->productos as $tupla)
    {
        echo"<tr>";
        echo"<td>".$tupla->cod."</td>";
        echo"<td>".$tupla->nombre_corto."</td>";
        echo"</tr>";

    } */
    echo"</table>";

   ?> 
</body>

</html>