
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   
    <h1>Estos son los datos enviados</h1>
    
    <?php 
    echo "<p><strong>Nombre:</strong>".$_POST["nombre"]."</p>";
    // nacido es un select solo muestro la selección
    echo "<p><strong>Nacido en:</strong>".$_POST["nacido"]."</p>";
    // controlo el sexo si ha sido o no seleccionado
    if (isset($_POST["sexo"])) {
        echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";
    } else {
        echo "<p><strong>Sexo: </strong>No seleccionado.</p>";
    }
    // primero controlo que marque uno de los tres
    if (isset($_POST['deportes']) || isset($_POST['lectura']) || isset($_POST['otros'])) {
        echo "<p><strong>Aficiones: </strong>Has seleccionado algo.</p>";
        //tengo que mostar 1.el que sea 2. el que sea       

    } else{

        echo "<p><strong>Aficiones: </strong>No seleccionado.</p>";
    }

    ?>


</body>
</html>



