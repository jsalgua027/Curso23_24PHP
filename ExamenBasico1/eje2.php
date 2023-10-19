<?php
if (isset($_POST["enviar"])) {

    $error_form = $_FILES["archivo"]["name"] == "" || $_FILES["archivo"]["error"] || $_FILES["archivo"]["type"] != "text/plain" || $_FILES["archivo"]["size"] > 1000 * 1024;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
               <!-- 
                            Realizar una página php con nombre ejercicio2.php, que te permita subir
                    un fichero txt no más grande de 1MB.
                    Si el fichero es subido con éxito, será movido con el nombre de
                    “archivo.txt” a una carpeta llamada “Ficheros”.
                    Informar de los posibles errores y cuándo no los haya, del resultado de la
                    operación ( Archivo subido o no con Éxito)

                -->
       <style>
            .error{

                color:red;
            }

       </style>         
</head>

<body>
    <form action="eje2.php" method="post" enctype="multipart/form-data">
        <label for="archivo">Seleccione un arhivo MAX(1mb)</label>
        <input type="file" name="archivo" id="archivo" accept=".txt">
        <?php
            if(isset($_POST["enviar"]) && $error_form){
                if( $_FILES["archivo"]["name"] == ""){
                    echo "<p class='error'>El archivo esta vacio</p>";
                }else if($_FILES["archivo"]["error"]){
                    echo "<p class='error'>No se ha podido subir el archivo al servidor</p>";
                }else if($_FILES["archivo"]["size"]){
                    echo "<p class='error'>El tamaño del archivo es incorrecto</p>";
                }else if($_FILES["archivo"]["type"]!=".txt"){
                    echo "<p class='error'>El formato del archivo no es el correcto</p>";
                }
            }
        ?>

        <button type="submit" name="enviar">Enviar</button>
    </form>
    <?php
    if(isset($_POST["enviar"]) && !$error_form){

      //  $nombre_nuevo=md5(uniqid(uniqid(),true)); numero hexadeccimal
        $nombre_nuevo="Archivo"; 
        // extraigo la extension del archivo
        $extension=substr($_FILES["archivo"]["name"],-4);
        // le concateno la extension al nombre nuevo
        $nombre_nuevo.=$extension;
        // subo el archivo a la carpeta
        @$var=move_uploaded_file($_FILES["archivo"]["tmp_name"],"Ficheros/" .$nombre_nuevo );
      //  echo "<p>La extension es : ".$extension."</p>";
        echo "<p>El archivo ha sido enviado correctamente</p>";
       
    }
    
    
    ?>


</body>

</html>