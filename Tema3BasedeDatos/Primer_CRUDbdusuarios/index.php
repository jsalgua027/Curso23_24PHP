<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 1 CRUD</title>

    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        th {
            background-color: #ccc;
        }

        table img {
            width: 75px;

        }

        .enlace {

            border: none;
            background: none;
            cursor: pointer;
            color: blue;

        }
    </style>
</head>

<body>
    <h1>Listado de usuarios</h1>


    <?php
    // REALIZO LA CONEXION
    try {
        $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_foro");
        // traduce los caracteres de la base de datos a nuestro codigo; hay que hacerlo 
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {

        //si no logro conectarme
        //OJO el die termina todo y necesita un fin de body y de html
        die("<p class='error'>No he podido conectarme a la base de datos: " . $e->getMessage() . " </p></body></html>");
    }

    //REALIZO LA CONSULTA
    try {
        $consulta = "select * from usuarios";
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {



        die("<p class='error'>No he podido realizar la consulta: " . $e->getMessage() . " </p></body></html>");
        // si falla , cierro conexión
        mysqli_close($conexion);
    }


    //IMPRIMO LA CONSULTA
    echo "<table>";
    echo "<tr><th>Nombre Usuario</th><th>Borrar</th><th>Editar</th></tr>";
    //recorro los datos
    while ($tupla = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button class='enlace' type='submit' value='" . $tupla["id_usuario"] . "' name='btnDetalle'>" . $tupla["nombre"] . "</form></td>";
        echo "<td><form action='index.php' method='post'><button type='submit' value='" . $tupla["id_usuario"] . "' name='btnBorrar'><img src='images/borrar2.png' alt= 'Imagen borrar'></button></form></td>";
        echo "<td><form action='index.php' method='post'><button type='submit' value='" . $tupla["id_usuario"] . "' name='btnEditar'><img src='images/editar2.png' alt= 'Editar borrar'></button></form></td>";

        echo "</tr>";
    }
    echo "</table>";



    if (isset($_POST["btnDetalle"])) {

        echo "<h3>Detalles del usuario con id:  " . $_POST["btnDetalle"] . "</h3>";

        //REALIZO LA CONSULTA
        try {
            $consulta = "select * from usuarios where id_usuario='" . $_POST["btnDetalle"] . "'";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {



            die("<p class='error'>No he podido realizar la consulta: " . $e->getMessage() . " </p></body></html>");
            // si falla , cierro conexión
            mysqli_close($conexion);
        }

        if (mysqli_num_rows($resultado) > 0) {

            $datos_usuarios = mysqli_fetch_assoc($resultado);


            echo "<p>";
            echo "<strong>Nombre: </strong>" . $datos_usuarios["nombre"] . "</br>";
            echo "<strong>Usuaio: </strong>" . $datos_usuarios["usuario"] . "</br>";
            echo "<strong>Email </strong>" . $datos_usuarios["email"] . "</br>";
            echo "</p>";
        } else {

            echo "<p>El usuario seleccionado no se encuentra registrado en la base de datos</p>";
        }


        //boton para volver al index
        echo "<form action= 'index.php'  method='post'>";
        echo "<p><button type='submit'>Volver</button></p>";
        echo "</form>";
        // si le da al boton borrar
    } elseif (isset($_POST["btnBorrar"])) {
        # code...
        //si le da al boton editar
    } elseif (isset($_POST["btnEditar"])) {
        # code...
    } else {

        echo "<form action= 'usuario_nuevo.php'  method='post'>";
        echo "<p><button type='submit' name='btnNuevoUsuario'>Insertar nuevo usuario</button></p>";
        echo "</form>";
    }

    //libero el cache

    mysqli_free_result($resultado);
    //cierro conexión
    mysqli_close($conexion);


    ?>
</body>

</html>