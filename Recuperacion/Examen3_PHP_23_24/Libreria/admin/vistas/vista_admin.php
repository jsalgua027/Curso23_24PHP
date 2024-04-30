<?php

/*****consulta para mostra la tabla******/
try {
    $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    session_destroy();
    die(error_page("Examen3 Librería", "<h1>Examen3 Librería</h1><p>Imposible conectar a la BD. Error:" . $e->getMessage() . "</p>"));
}

try {

    $consulta = "SELECT * FROM libros ";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute();
} catch (PDOException $e) {
    $sentencia = null;
    $conexion = null;
    session_destroy();
    die(error_page("Examen3 Librería", "<h1>Examen3 Librería</h1><p>Imposible realizar la consulta. Error:" . $e->getMessage() . "</p>"));
}
$libros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
$sentencia = null;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error {
            color: red
        }

        .en_linea {
            display: inline
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }

        table {
            border-collapse: collapse;
            width: 23%;
        }

        table,
        th,
        td {
            border: 1px solid black
        }

        th {
            background-color: #CCC
        }

        .reducida {
            height: 100px
        }

        .img_editar {
            width: 30%
        }

        .centrar {
            width: 80%;
            margin: 0 auto;
        }

        .mensaje {
            font-size: 1.25rem;
            color: blue
        }

        #t_editar,
        #t_editar td {
            border: none
        }

        .centrado {
            text-align: center;
        }

        .d_flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5em
        }

        .contenedor {
            display: flex;
            flex-wrap: wrap;
        }

        .list_libros {
            border: 1px solid black;
            margin: 0.5rem;
            flex: 0 25%;
        }
    </style>
</head>

<body>
    <h1>ESTOY EN EL GESTOR DE LIBROS</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log["lector"]; ?></strong> -
        <form class="en_linea" action="../index.php" method="post">
            <button class="enlace" name="btnSalir" type="submit">Salir</button>
        </form>
    </div>
    <h1>Listado de los Libros</h1>

    <?php
    echo "<table class='contenedor'>";
    echo"<tr><th>Ref</th><th>Título</th><th>Acción</th></tr>";
    foreach ($libros as $tupla) {
       echo "<tr>";
       echo "<td>".$tupla["referencia"]."</td>";
       echo "<td>".$tupla["titulo"]."</td>";
       echo "<td><form action='' method='post'><button class='enlace' type='submit' value='".$tupla["referencia"]."' name='btnBorrar'>Borrar</button>-<form action='' method='post'><button class='enlace' type='submit' value='".$tupla["referencia"]."' name='btnEditar'>Editar</button></form></td>";
       echo"</tr>";
    }
    echo "</table>";

    ?>
</body>

</html>