<?php


if (isset($_POST["btnBorrarUser"])) {
    try{
        $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); 
    }
    catch(PDOException $e){
        session_destroy();
        die(error_page("Práctica Rec 2","<h1>Práctica Rec 2</h1><p>Imposible conectar a la BD. Error:".$e->getMessage()."</p>"));
    }
    try {
        $consulta = "DELETE FROM usuarios WHERE usuario=?";
        $usuario = $_POST["btnBorrarUser"]; // el value del boton 
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario]);
    } catch (PDOException $e) { // si falla la conexion
        $sentencia = null;
        $conexion = null;
        die("<p>No hacer el borrado por fallo de la conexión: " . $e->getMessage() . "</p></body></html>");
    }
}



//aqui hago la consulta a la base de datos para mostralos si al usuario es admin
// genero la conexion
try{
    $conexion=new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); 
}
catch(PDOException $e){
    session_destroy();
    die(error_page("Práctica Rec 2","<h1>Práctica Rec 2</h1><p>Imposible conectar a la BD. Error:".$e->getMessage()."</p>"));
}

try {
    $consulta = "select * from usuarios";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute();
} catch (PDOException $e) { // si falla la conexion
    $sentencia = null;
    $conexion = null;
    die("<p>No hacer la consulta por fallo de la conexión: " . $e->getMessage() . "</p></body></html>");
}
if ($sentencia->rowCount() > 0) {
    $todos_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
} else {
    echo "<p>no hay Usuarios en la tabla solitada</p>";
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td,
        th {
            border: 1px solid black
        }

        table {
            border-collapse: collapse
        }

        th {
            background-color: #CCC
        }

        table img {
            width: 50px;
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

        .mensaje {
            color: blue;
            font-size: 1.5em
        }

        .txt_centrado {
            text-align: center
        }

        .no_bordes {
            border: none
        }

        .centrado {
            width: 80%;
            margin: 0 auto
        }

        .grande {
            font-size: 1.5em
        }
    </style>
</head>

<body>
    <h1>USUARIO ADMIN</h1>
    <h2>Práctica Rec2</h2>
    <div>Bienvenido <strong><?php echo $_SESSION["usuario"]; ?></strong> -
        <form class='enlinea' action="index.php" method="post">
            <button class='enlace' type="submit" name="btnSalir">Salir</button>
        </form>
    </div>
    <?php

    if (isset($_POST["btnNuevoUser"]))
        require "vistas/vista_nuevo_user.php";

    ?>
    <h2>Lista de Usuarios</h2>
    <?php
    echo "<table id='tb_principal' class='txt_centrado centrado'>";
    echo "<tr><th>#</th><th>Foto</th><th>Nombre</th><th><form action='index.php' method='post'<button class='enlace' type='submit' name='btnNuevoUser'>Usuario+</button></form></th></tr>";
    foreach ($todos_usuarios as $tupla) {
        echo "<tr>";
        echo "<td>" . $tupla["id_usuario"] . "</td>";
        echo "<td><img src='images/" . $tupla["foto"] . "'name='foto'title='fotoUser'></td>";
        echo "<td>" . $tupla["nombre"] . "</td>";
        echo "<td><form action='index.php' method='post'><button class='enlace' name='btnBorrarUser' value='" . $tupla["usuario"] . "'>Borrar</button> - <button class='enlace' name='btnEditar' value='" . $tupla["usuario"] . "'>Editar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>

</html>