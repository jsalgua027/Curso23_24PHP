<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas de productos</title>
    <style>
        h1{text-align: center;}
        .enlinea {
            display: inline
        }

         .enlace {
            border: none;
            background: none;
            text-decoration: underline;
            color: blue;
            cursor: pointer
        } 

        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            text-align: center;
            width: 90%;
            margin: 0 auto
        }

        th {
            background-color: #CCC
        }

       
    </style>
</head>

<body>
    <h1>Lista de productos</h1>
    <?php
    define("DIR_SERV", "http://localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/ServiciosWeb/Ejercicio1/servicios_rest");
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
    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }
    if (isset($obj->mensaje_error)) {
        die("<p>" . $obj->mensaje_error . "</p></body></html>");
    }
    echo "<table>";
    echo "<tr><th>COD</th><th>Nombre</th><th>PVP</th><th><form action='index.php' method='post'><input type='hidden' name='agregar'><button class='enlace' type='submit' name='btnAgregar' value=''>Productos+</button></form></th></tr>";
    foreach ($obj->productos as $tupla) {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' name='btnDetalle' value='".$tupla->cod ."'>".$tupla->cod ."</button> </form></td>";
        echo "<td>" . $tupla->nombre_corto . "</td>";
        echo "<td>" . $tupla->PVP . "</td>";
       echo "<td><form action='index.php' method='post'><input type='hidden' name='borrar' value='".$tupla->cod ."'><button class='enlace' type='submit' name='btnBorrar' value='".$tupla->cod."'>Borrar</button> - <button class='enlace' type='submit' name='btnEditar' value='".$tupla->cod."'>Editar</button></form></td>";
          echo "</tr>";
    }
    echo "</table>";
  // so le doy al boton detalle  lo muestro
    if(isset($_POST["btnDetalle"])){
    $url = DIR_SERV . "/productos/".urlencode($_POST["btnDetalle"]);
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta);
    if (!$obj) {
        die("<p>Error consumiendo el servicio: " . $url . "</p>" . $respuesta);
    }
    if (isset($obj->mensaje_error)) {
        die("<p>" . $obj->mensaje_error . "</p></body></html>");
    }
    }
    /* for ($i=0; $i <count($obj) ; $i++) { 
       echo"<p>".$obj[$i]."</p>";
      /*  echo"<p>".$obj->productos[$i]->cod."</p>";
    } 
     */
    echo $_POST["btnDetalle"];
    ?>
</body>

</html>