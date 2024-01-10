<DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3.POO</title>
</head>

<body>
    <h1>Ejercicio 4.POO</h1>
    <h3>Herencia, una uva que hereda de Fruta</h3>
    <?php
    
    require "class_uva.php";
    //creo una variable que es una instancia de la clase fruta
    //imprimirlo
    $uva= new Uva("verde","pequeña",false);

    echo"<h2>Información de mi uva creada</h2>";
    if($uva->tienenSemilla()){
        echo"<p>La uva creada es de color ".$uva->get_color().", tamaño ".$uva->get_tamanyo()." y tiene semilla</p>";

    }else{
        echo"<p>La uva creada es de color ".$uva->get_color().", tamaño ".$uva->get_tamanyo()." y no tiene semilla</p>";
    }


  
    ?>
</body>

</html>