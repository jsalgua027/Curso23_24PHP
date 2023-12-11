<?php
if (isset($_POST["btnEnviar"])) {
    $error_archivo = $_FILES["archivo"]["name"] == "" || $_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024;    // cuando es una foto se pregunta por el $_FILES
    /*
             $_FILES["archivo"]["name"]-----nombre que tiene el usuario en su ordenador
             $_FILES["archivo"]["error"]----cuando no se a podido subir
             $_FILES["archivo"]["type"]----tipo de fichero no la extension
             $_FILES["archivo"]["tmp_name"]------  la dirección y el nombre como se guarda en el servidor
             $_FILES["archivo"]["size"]>500*1024 ---controlo el tamanio de foto
    */
}

if (isset($_POST["btnEnviar"]) && !$error_archivo) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>teoria subir fichero al servidore</title>
        <style>
            .error {

                color: red
            }
        </style>
    </head>

    <body>
        <h1>teoria subir ficheros al servidor</h1>
        <h2>Datos del archivo subido</h2>
        <?php
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
        ?>

    </body>

    </html>

<?php
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>teoria subir fichero al servidore</title>
        <style>
            .error {

                color: red
            }
        </style>
    </head>

    <body>
        <h1>teoria subir ficheros al servidor</h1>
        <!--Para trabajar con archivos siempre post y el ecntype pero lo ponemos SIEMPRE en todos los formularios-->
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="archivo">Seleccione un archivo imagen(Max 500KBS)</label>
                <input type="file" name="archivo" id="archivo" accept="image/*" />
                <?php
                if (isset($_POST["btnEnviar"]) && $error_archivo) {
                    // si hay un error al subir al servidor
                    if ($_FILES["archivo"]["name"] != "") {
                        // si no se almacena correctamente al servidor
                        if ($_FILES["archivo"]["error"]) {
                            echo "<span class='error'> No se ha podido subir el archivo al servidor</span>";
                        } elseif (!getimagesize($_FILES["archivo"]["tmp_name"])) {

                            echo "<span class='error'>El archivo seleccionado no es una fotografia</span>";
                        } else {
                            echo "<span class='error'> El archivo seleccionado supera los 500 MAX</span>";
                        }
                    }
                }

                ?>
            </p>

            <p>

                <button type="submit" name="btnEnviar">Enviar</button>
            </p>
        </form>


    </body>

    </html>

<?php
}
?>