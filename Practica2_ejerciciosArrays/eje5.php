<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 5</h1>
    <?php  
        $persona['Nombre']="Pedro Torres";
        $persona['Dirección']="C/Mayor. 37";
        $persona['Telèfono']=123456789;

        foreach ($persona as $datos => $valor) {
            echo "<p>"."Su ".$datos." es: ".$valor."</p><br/>";
        }    
    
    ?>
    
</body>
</html>