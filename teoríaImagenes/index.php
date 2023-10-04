<?php
if (isset($_POST["btnEnviar"])) {
    $error_archivo = $_FILES["archivo"]["name"] == "" || $_FILES["archivo"]["error"] || !getimagesize($_FILES["archivo"]["tmp_name"]) || $_FILES["archivo"]["size"] > 500 * 1024;    // cuando es una foto se pregunta por el $_FILES
    /*
            $_FILES["archivo"]["error"]----cuando no se a podido subir
            !getimagesize( $_FILES["archivo"]["tmp_name"]) lo que se a subido es una imagen
             $_FILES["archivo"]["size"]>500*1024 controlo el tamanio de foto
    */
}

if (isset($_POST["btnEnviar"]) && !$error_archivo) {

    echo "contesto con la info del archivo";
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
        <form action="index.php" method="post" enctype="multipart/form-data">
            <p>
                <label for="archivo">Seleccione un archivo imagen(Max 500KBS)</label>
                <input type="file" name="archivo" id="archivo" accept="image/*" />
                <?php
                if (isset($_POST["btnEnviar"]) && $error_archivo) {
                    //con esto obligo a subir un fichero
                    if ($_FILES["archivo"]["name"] != "") {

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