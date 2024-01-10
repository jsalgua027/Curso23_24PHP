<DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3.POO</title>
</head>

<body>
    <h1>Ejercicio 3.POO</h1>
    <h3>Probando el mentodo estatico que cuenta y el metodo que destruye</h3>
    <?php
    require "class_fruta.php";
    //creo una variable que es una instancia de la clase fruta
    //imprimirlo
    echo "<h2>INFORMACIÓN DE MIS FRUTAS</h2>";
    echo"<p>Frutas creadas hasta el momento: ".Fruta::cuantasFrutas()."</p>";
    $pera = new Fruta("verde", "mediano");
    echo"<p>Creando la pera</p>";
    echo"<p>Frutas creadas hasta el momento: ".Fruta::cuantasFrutas()."</p>";
    echo"<p>Creando el melón</p>";
    $melon = new Fruta("amarillo", "grande");
    echo"<p>Frutas creadas hasta el momento: ".Fruta::cuantasFrutas()."</p>";
    echo"<p>Destruyo el melon</p>";
    unset($melon);
    echo"<p>Frutas creadas hasta el momento: ".Fruta::cuantasFrutas()."</p>";
    ?>
</body>

</html>