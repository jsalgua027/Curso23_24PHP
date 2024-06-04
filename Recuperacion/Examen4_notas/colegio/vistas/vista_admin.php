<?php
    if(isset($_POST["btnBorrarNota"]))
    {
        $datos_env["cod_asig"]=$_POST["cod_asig"];
        $respuesta = consumir_servicios_REST(DIR_SERV . "/quitarNota/".$_POST["cod_usu"], "DELETE", $datos_env);
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
            header("Location:" . $salto);
            exit();
        }


        $_SESSION["mensaje_accion"]="Asignatura descalficiada con Exito";
        // queiro tambien mantener el alumno
        $_SESSION["alumno"]=$_POST["cod_usu"];
        header("Location:index.php");
        exit;
    }
    // si le doy a borrar recargo la tabla 
    if(isset($_SESSION["alumno"]))
    {
        $_POST["alumnoSeleccionado"]=$_SESSION["alumno"];
        unset($_SESSION["alumno"]);
    }


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
    header("Location:" . $salto);
    exit();
}

$todos_alumnos = $json["alumnos"];





if (isset($_POST["btnVerNotas"])) {


    $respuesta = consumir_servicios_REST(DIR_SERV . "/notasAlumno/" . $_POST["alumnoSeleccionado"], "GET", $datos_env);

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
        header("Location:inex.php");
        exit();
    }


    $notas_Alumno = $json["notas"];

    /*

    $respuesta = consumir_servicios_REST(DIR_SERV . "/NotasNoEvalAlumno/" . $cod_usu, "GET", $datos_env);

    $jsonNo = json_decode($respuesta, true);
    if (!$jsonNo) {
        session_destroy();
        die(error_page("Examen 4 Notas", "<h1>Examen 4 Notas</h1><p>Sin respuesta oportuna de la API asignaturas Alumno no evaluadas</p>"));
    }
    if (isset($jsonNo["error"])) {

        session_destroy();
        consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos_env);
        die(error_page("Examen 4 Notas", "<h1>Examen 4 Notas</h1><p>" . $jsonNo["error"] . "</p>"));
    }

    if (isset($jsonNo["no_auth"])) {
        session_unset();
        $_SESSION["seguridad"] = "Usted ha dejado de tener acceso a la API. Por favor vuelva a loguearse.";
        header("Location:" . $salto);
        exit();
    }

    if (isset($jsonNo["notas"]) && count($jsonNo["notas"]) > 0) {
        $datos_Asig_NO_Evau =  $jsonNo["notas"]; // asignaturas no evaluadas
    }

*/
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
    <?php
    if (count($todos_alumnos) <= 0) {
        echo "<p>En estos momento no tenemos registrados alumnos en la base de datos</p>";
    } else {
    ?>

        <form class="en_linea" action="index.php" method="post">
            <p>
                <label for="seleccion">Seleccione a un alumno</label>
                <select for="alumnos" name="alumnoSeleccionado">
                    <?php
                    foreach ($todos_alumnos as $tupla) {
                        if (isset($_POST["alumnoSeleccionado"]) && $_POST["alumnoSeleccionado"] == $tupla["cod_usu"]) // para mantener el seleccionado
                        {
                            echo "<option  selected value='" . $tupla["cod_usu"] . "'>" . $tupla["nombre"] . "</option>";
                            $nombre_alumno_seleccionado = $tupla["nombre"];
                        } else {
                            echo "<option value='" . $tupla["cod_usu"] . "'>" . $tupla["nombre"] . "</option>";
                        }
                    }
                    ?>

                </select>
                <button name="btnVerNotas" type="submit">Ver Notas</button>
            </p>
        </form>
        <?php
        if (isset($_POST["alumnoSeleccionado"]) || isset($_POST["btnEditar"])) { // por aqui lo dejamos

            echo "<h2>Notas del Alumno " . $nombre_alumno_seleccionado  . "</h2>";
            echo "<table class='table'>";
            echo "<tr><th>Asignaturas</th><th>Notas</th><th>Accion</th></tr>";


            foreach ($notas_Alumno as $tupla) {
                echo "<tr>";
                echo "<td>" . $tupla["denominacion"] . "</td>";
                echo "<td>" . $tupla["nota"] . "</td>";
                echo "<td><form action='index.php' method='post'>";
                echo "<input type='hidden' name='cod_usu' value='" . $_POST["alumnoSeleccionado"] . "'>";
                  echo "<input type='hidden' name='cod_asig' value='" . $tupla["cod_asig"] . "'>";
                // echo"<button class='enlace' name='btnEditar' type='submit'>Editar</button>-<button class='enlace' name='btnBorrar' type='submit'>Borrar</button>";
                if (isset($_POST["btnEditar"])) {
                    echo "<button class='enlace' name='btnCambiar' type='submit'>Cambiar</button>-<button class='enlace' name='btnAtras' type='submit'>Atras</button>";
                } else {
                    echo "<button class='enlace' name='btnEditar' type='submit'>Editar</button>-<button class='enlace' name='btnBorrar' type='submit'>Borrar</button>";
                }
                echo "</form></td>";
                echo "<tr>";
            }

            
            echo "</table>";
            if(isset($_SESSION["mensaje_accion"]))
            {
                echo"<p class='mensaje'>".$_SESSION["mensaje_accion"]."</p>";
                
            }


                    /*
                    if (count($datos_notas_alum) == 3) {
                        echo "<p>A " . $nombre_alumno_seleccionado . " no quedan asignaturas por calificar</p>";
                    }
                    if (count($datos_notas_alum) < 3) {
                        echo "<p>";
                        echo "<form action='index.php' method='post'>";
                        echo "<label for='asignaturasNO'>Asignaturas que a <strong> " . $nombre_alumno_seleccionado . " </strong> aún le queda por calificar </label>";
                        echo "<select for='asignaturasNO' name='asignaturasNO'>";
                        foreach ($datos_Asig_NO_Evau as $tupla) {
                            echo "<option value='" . $tupla["cod_asig"] . "'>" . $tupla["denominacion"] . "</option>";
                        }
                        echo "</select>";
                        echo " <button name='btnCalificar' type='submit'>Calificar</button>";
                        echo "</form>";
                        echo "</p>";
                    }
                 
                 */
        }


        ?>
        </div>


    <?php
    }

    ?>


    <div>


</body>

</html>