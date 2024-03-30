<h1>Esto son los datos enviados</h1>
<p><strong>El nombre enviado ha sido:</strong><?php echo $_POST["nombre"]; ?></p>
<p><strong>Ha nacido en:</strong><?php echo $_POST["ciudades"]; ?></p>
<p><strong>El sexo es:</strong><?php echo $_POST["sexo"]; ?></p>
<?php
if (isset($_POST["aficiones"])) {
    echo "<p><strong>Las aficiones seleccionas han sido:</strong></p>";
    echo "<ol>";
    for ($i = 0; $i < count($_POST["aficiones"]); $i++) {
        echo "<li>" . $_POST["aficiones"][$i] . "</li>";
    }
    echo "</ol>";
} else {
    echo "<p>No has seleccionado ninguna afición</p>";
}
echo "<p>El comentario realizado  ha sido: <strong>" . $_POST["comentarios"] . "</strong></p>";
echo "<h2> Información de la imagen seleccionada</h2>";

if ($_FILES["foto"]["name"] != "") {
    $array_ext = explode(".", $_FILES["foto"]["name"]); // meto en un array el nombre divido por la . , asi obtengo el nombre y la extension por separado
    $ext = "." . strtolower(end($array_ext)); // me quedo con la extension y le concateno el punto
    $nombre_nuevo = md5(uniqid(uniqid(), true)); // creo un numero clave para concaternalo a la extension
    $nombre_archivo = $nombre_nuevo . $ext; //concateno el nombre nuevo y la extension
    @$var = move_uploaded_file($_FILES["foto"]["tmp_name"], "images/" . $nombre_archivo); // subo a la carpeta el archivo
    echo "<h3>Foto</h3>";
    echo "<p><strong>Nombre: </strong>" . $_FILES["foto"]["name"] . "</p>";
    echo "<p><strong>Tipo: </strong>" . $_FILES["foto"]["type"] . "</p>";
    echo "<p><strong>Tamanio: </strong>" . $_FILES["foto"]["size"] . "</p>";
    echo "<p><strong>Error: </strong>" . $_FILES["foto"]["error"] . "</p>";
    echo "<p><strong>El tmp_name: </strong>" . $_FILES["foto"]["tmp_name"] . "</p>";
    echo "<p>La imagen subida con exito</p>";
    echo "<p><img class='tan_img' src='images/" . $nombre_archivo . "' alt='Foto' title='Foto'/></p>";

    echo"<h2>Parte Teórica de las fotos</h2>";
    echo"<p>Obtengo el array con el explode muestro en una lista cada elento del array obtenido</p>";
    echo"<ul>";
        for ($i=0; $i <count($array_ext) ; $i++) { 
            echo "<li>" . $array_ext[$i] . "</li>";
        }
    echo"</ul>";
    echo"<p><strong>La extensión es: </strong> ".$ext." </p>";
    echo"<p><strong>El nombre nuevo es: </strong> ".$nombre_nuevo." </p>";
    echo"<p><strong>El nombre del archivo es: </strong> ".$nombre_archivo." </p>";
} else {
    echo "<span> No se ha podido mover la imgen a la carpeta destino en el servidor</span>";
}


?>