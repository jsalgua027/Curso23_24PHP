<?php
session_start();

if (isset($_POST["btnBorrar"])) {
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_videoclub");
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("Práctica 9  <h1>Práctica 9</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() .  "</p></body></html>");
    }
    //}
    try {
        $consulta = " delete  from peliculas where idPelicula=' " . $_POST["btnBorrar"] . "'";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        die(error_page("Error", "<p>Ha habido un error: " . $e->getMessage() . "</p>"));
    }

    //si la caratula es distinta de  de no imagen la borras
    if ($_POST["caratula_bd"] != "no_imagen.jpg") {
        unlink("Img/" . $_POST["caratula_bd"]);
    }

    mysqli_close($conexion);
    header("Location:index.php");
    exit();
}
//vamos a editar
//controlo errores
if(isset($_POST["btnConEditar"])){



}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VideoClub</title>
    <style>
        table,
        td,
        th {
            border: 1px solid;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        th {

            background-color: #CCC;
            width: 20%;
        }

        img {
            width: 70px;
        }

        img#foto-caratula {
            width: 250px;
        }

        .enlace {
            border: none;
            background: none;
            cursor: pointer;
            color: blue;
            text-decoration: underline
        }

        .error {
            color: red
        }

        input.sinopsis {
            width: 50px;
            height: 50px;
        }

        div {
            display: flex;
            flex-direction: row;
        }

        p {
            margin: 10px;
        }

        button#btnAtras {

            width: 200px;

        }
    </style>
</head>

<body>
    <?php
    require "vistas/vistas_tabla.php";
    if (isset($_POST["btnDetalle"])) {
        require "vistas/vistas_detalle.php";
    }
    if (isset($_POST["btnEditar"])) {
        require "vistas/vista_editar.php";
    }
    ?>
</body>

</html>