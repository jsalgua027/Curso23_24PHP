<?php
session_name("ejer_05_23_24");
session_start();

if (!isset($_SESSION["posicionX"])&&!isset($_SESSION["posiciony"])) {
    $_SESSION["posicionX"] = 0;
    $_SESSION["posicionY"] = 0;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1{text-align: center;}
        form{display:flex ;
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
        svg{
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Mover el punto de Derecha a Izquierda</h1>
    <h2>Haga clic en los botones para mover el punto:</h2>
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
            <svg version="1.1" xmlns=http://www.w3.org/2000/svg width="400px" height="400px" viewbox="-300 0 600 20">
               
                <circle cx="<?php echo  $_SESSION["posicionX"] ?>" cy="<?php echo  $_SESSION["posicionY"] ?>" r="15" fill="red" />
            </svg>


        </div>



    </form>

</body>

</html>