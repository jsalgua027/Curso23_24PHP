<?php
/*
La declaración viewBox en un elemento SVG define el área de visualización y el sistema de coordenadas para el contenido SVG. El valor de viewBox es una cadena que representa cuatro números separados por espacios: min-x min-y width height.

min-x y min-y son las coordenadas (x, y) del punto superior izquierdo del viewBox en el sistema de coordenadas del documento.
width y height son las dimensiones del viewBox.
El atributo width y height en el elemento SVG establece el tamaño del contenedor SVG en la página.

La relación entre el viewBox y el width/height es importante para mantener la proporción correcta del contenido SVG. En el ejemplo que proporcioné (viewBox="-200 -200 400 400"), los valores significan:

min-x = -200
min-y = -200
width = 400
height = 400
*/
session_name("ejer_05_23_24");
session_start();

if (!isset($_POST["boton"])&& (!isset($_SESSION["posicionX"]) && !isset($_SESSION["posicionY"]))) {
    $_SESSION["posicionX"] = 0;
    $_SESSION["posicionY"] = 0;

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio5</title>
    <style>
        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: row;
            align-items: center;

        }

        .botonera {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 200px;
        }

        .central {
            width: 40px;
            font-size: xx-small;
            margin-bottom: 2px;
        }

        button {
            width: 50px;
        }

        svg {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Mover el punto de Derecha a Izquierda</h1>
    <h2>Haga clic en los botones para mover el punto:</h2>
    <?php
    echo  $_SESSION['posicionX'];
    echo  $_SESSION['posicionY'];
    ?>
    <form action="sesiones05_2.php" method="post">

        <div class="botonera">
            <button type="submit" name="boton" value="arriba"> &#x1F446</button>
            <div class="bcentral">
                <button type="submit" name="boton" value="izquierda">&#x1F448</button>
                <button type="submit" name="boton" value="centro" class="central">Volver centro</button>
                <button type="submit" name="boton" value="derecha"> &#x1F449</button>
            </div>
            <button type="submit" name="boton" value="abajo"> &#x1F447</button>
        </div>
        <div class="tablero">
            <svg version="1.1" xmlns=http://www.w3.org/2000/svg width="400px" height="400px" viewbox="-200 -200 400 400">

                <circle cx="<?php echo  $_SESSION["posicionX"]?>" cy="<?php echo  $_SESSION["posicionY"]?>" r="10" fill="red" />
            </svg>


        </div>



    </form>

</body>

</html>