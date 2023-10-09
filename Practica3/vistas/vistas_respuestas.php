<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1> Recogida los datos</h1>
    <?php


    echo "<p><strong>Nombre: </strong>" . $_POST["nombre"] . "</p>";
    echo "<p><strong>Apellidos: </strong>" . $_POST["apellidos"] . "</p>";
    echo "<p><strong>Contraseña: </strong>" . $_POST["clave"] . "</p>";
    echo "<p><strong>Contraseña: </strong>" . $_POST["dni"] . "</p>";

    // isset es si existe el dato muy importante
    // sexo si esta seleccionado muestro sino indicico que no esta seleccionado 
    if (isset($_POST["sexo"])) {
        echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";
    } else {
        echo "<p><strong>Sexo: </strong>No seleccionado.</p>";
    }
    // nacido muestro el resultado; es un select al final tiene que marcar uno o habra uno por defecto
    echo "<p><strong>Nacido: </strong>" . $_POST["nacido"] . "</p>";

    echo "<p><strong>Comentarios: </strong>" . $_POST["comentarios"] . "</p>";

    if (isset($_POST["boletin"])) {

        echo "<p><strong>Subscripcion: </strong>si</p>";
    } else {

        echo "<p><strong>Subscripcion: </strong>no</p>";
    }
    if ($_FILES["archivo"]["name"] != "") {
// con este proceso pasamos el archivo de la foto a donde esta  nuestro proyecto
        $nombre_nuevo = md5(uniqid(uniqid(), true));
        //extraigo la extension el archivo
        $array_nombre = explode(",", $_FILES["archivo"]["name"]);
        $ext = "";
        // el numero calculado en nombre nuevo le añado la extension
        if (count($array_nombre) > 1) {

            $ext = "." . end($array_nombre);
        }

        $nombre_nuevo .= $ext;
        @$var = move_uploaded_file($_FILES["archivo"]["tmp_name"], "images/" . $nombre_nuevo);
        if ($var) {
            /*
                    forma de mostralo por samu
                    <p>
                        <table>
                            <?php
                            foreach ($_FILES["archivo"] as $key => $value) {
                                echo "<tr>";
                                echo "<th>" . $key . "</th>";
                                echo "<td>" . $value . "</td>";
                                echo "</tr>";
                            }
                            
                            ?>
                        </table>
                        </p>
    
    
                */
            echo "<h3>Foto</h3>";
            echo "<p><strong>Nombre: </strong>" . $_FILES["archivo"]["name"] . "</p>";
            echo "<p><strong>Tipoe: </strong>" . $_FILES["archivo"]["type"] . "</p>";
            echo "<p><strong>Tamanio: </strong>" . $_FILES["archivo"]["size"] . "</p>";
            echo "<p><strong>Error: </strong>" . $_FILES["archivo"]["error"] . "</p>";
            echo "<p><strong>Archivo en el temporal del servidor : </strong>" . $_FILES["archivo"]["tmp_name"] . "</p>";
            echo "<p>La imagen subida con exito</p>";
            echo "<p><img class='tan_img' src='images/" . $nombre_nuevo . "' alt='Foto' title='Foto'/></p>";
        } else {

            echo "<span> NO se ha podido mover la imgen a la carpeta destino en el servidor</span>";
        }
    }

    ?>
</body>

</html>