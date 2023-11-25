<?php
session_start();

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