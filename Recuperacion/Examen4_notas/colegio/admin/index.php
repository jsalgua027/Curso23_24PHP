<?php
session_name("Examen_4_SW");
session_start();
require "../src/func_ctes.php";
require "../src/seguridad.php";

$respuesta = consumir_servicios_REST(DIR_SERV . "/alumnos", "GET", $datos_env);
$json = json_decode($respuesta, true);
if (!$json) {
    session_destroy();
    die(error_page("Examen 4 Notas", "<h1>Examen 4 Notas</h1><p>Sin respuesta oportuna de la API</p>"));
}
if (isset($json["error"])) {

    session_destroy();
    consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos_env);
    die(error_page("Examen 4 Notas", "<h1>Examen 4 Notas</h1><p>" . $json["error"] . "</p>"));
}

if (isset($json["no_auth"])) {
    session_unset();
    $_SESSION["seguridad"] = "Usted ha dejado de tener acceso a la API. Por favor vuelva a loguearse.";
    header("Location:index.php");
    exit();
}

$todos_alumnos = $json["alumnos"];
$nombre_alumno_seleccionado = ""; // variable para el nombre seleccionado al ver las notas
$datos_notas_alum = []; // inicio la variable para su correcto uso si no hay notas

if (isset($_POST["btnVerNotas"])) {
    $cod_usu = $_POST["alumnoSeleccionado"];
    // Encontrar el nombre del alumno seleccionado
    foreach ($todos_alumnos as $tupla) {
        if ($tupla["cod_usu"] == $cod_usu) {
            $nombre_alumno_seleccionado = $tupla["nombre"];
            break;
        }
    }

    $cod_usu = $_POST["alumnoSeleccionado"];
    $respuesta = consumir_servicios_REST(DIR_SERV . "/notasAlumno/" . $cod_usu, "GET", $datos_env);

    $json = json_decode($respuesta, true);
    if (!$json) {
        session_destroy();
        die(error_page("Examen 4 Notas", "<h1>Examen 4 Notas</h1><p>Sin respuesta oportuna de la API notasAlumno en la seleccion</p>"));
    }
    if (isset($json["error"])) {

        session_destroy();
        consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos_env);
        die(error_page("Examen 4 Notas", "<h1>Examen 4 Notas</h1><p>" . $json["error"] . "</p>"));
    }

    if (isset($json["no_auth"])) {
        session_unset();
        $_SESSION["seguridad"] = "Usted ha dejado de tener acceso a la API. Por favor vuelva a loguearse.";
        header("Location:index.php");
        exit();
    }

    if (isset($json["notas"]) && count($json["notas"]) > 0) {
        $datos_notas_alum = $json["notas"];
    }
    
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
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

        .mensaje {
            font-size: 1.25em;
            color: blue
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th {
            background-color: gray;
        }
    </style>
</head>

<body>
    <h1>Notas de los Alumnos: Vista Tutor</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log["usuario"]; ?></strong> -
        <form class="en_linea" action="../index.php" method="post">
            <button class="enlace" name="btnSalir" type="submit">Salir</button>
        </form>
    </div>

    <div>

        <form class="en_linea" action="index.php" method="post">
            <p>
                <label for="seleccion">Seleccione a un alumno</label>
                <select for="alumnos" name="alumnoSeleccionado">
                    <?php
                    foreach ($todos_alumnos as $tupla) {
                        echo "<option value='" . $tupla["cod_usu"] . "'>" . $tupla["nombre"] . "</option>";
                    }
                    ?>

                </select>
                <button name="btnVerNotas" type="submit" value='<?php $_POST["alumnoSeleccionado"] ?>'>Ver Notas</button>
            </p>
        </form>
        <?php
        if (isset($_POST["btnVerNotas"])) {

            echo "<h2>Notas del Alumno " . $nombre_alumno_seleccionado . "</h2>";
            echo "<table class='table'>";
            echo "<tr><th>Asignaturas</th><th>Notas</th><th>Accion</th></tr>";
          if(count($datos_notas_alum) > 0)
          {
            foreach ($datos_notas_alum as $tupla) {
                echo "<tr>";
                echo "<td>" . $tupla["denominacion"] . "</td>";
                echo "<td>" . $tupla["nota"] . "</td>";
                echo "<tr>";
            }
          }
          else
          {
            echo"<p>NO TIENEN ASIGANURAS CALIFICADAS</p>";
          }
            
            echo "</table>";
        }


        ?>
    </div>
</body>

</html>