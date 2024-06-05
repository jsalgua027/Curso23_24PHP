<?php
// SI LE DAMOS A BORRAR
if (isset($_POST["btnBorrarNota"]))
 {
    $datos_env["cod_asig"] = $_POST["cod_asig"];
    $respuesta = consumir_servicios_REST(DIR_SERV . "/quitarNota/" . $_POST["alumnoSeleccionado"], "DELETE", $datos_env);
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


    $_SESSION["mensaje_accion"] = "Asignatura descalficiada con Exito";
   
    // queiro tambien mantener el alumno
    $_SESSION["alumnoSeleccionado"] = $_POST["alumnoSeleccionado"];
    header("Location:index.php");
    exit;
}
// si le doy a borrar recargo la tabla 
if (isset($_SESSION["alumnoSeleccionado"])) {
    $_POST["alumnoSeleccionado"] = $_SESSION["alumnoSeleccionado"];
    unset($_SESSION["alumnoSeleccionado"]);
}

// AQUI LA GESTION CON EL SELECT 
if (isset($_POST["alumnoSeleccionado"]))
 {

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


    $notas_Alumno = $json["notas"]; // me quedo con las notas del alumno
    //asignaturas pendientes por evaluar  
    $respuesta = consumir_servicios_REST(DIR_SERV . "/notasNoEvalAlumno/" . $_POST["alumnoSeleccionado"], "GET", $datos_env);

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

    $datos_Asig_NO_Evau=$json["asignaturas"];

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
        header("Location:index.php");
        exit();
    }

    $todos_alumnos = $json["alumnos"];

 // AQUI SI LE DAMOS A CAMBIAR NOTA

 if(isset($_POST["btnCambiarNota"]))
 {
    // el control de errores y la llamada al servicio para cambiar la nota
    $error_form=$_POST["nota"]==""||!is_numeric($_POST["nota"]) || ($_POST["nota"]<0 || $_POST["nota"]>10);
  if(!$error_form)
   {
    // hago la llamada ******OJO esto hay que arreglarlo
    $datos_env["cod_asi"]=$_POST["cod_asid"];
    $datos_env["nota"]=$_POST["nota"];
    $respuesta = consumir_servicios_REST(DIR_SERV . "/cambiarNota/" . $_POST["alumnoSeleccionado"], "PUT", $datos_env);
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


    $_SESSION["mensaje_accion"] = "Asignatura descalficiada con Exito";
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
        .editarNota{
            border-color: orangered;
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
        if (isset($_POST["alumnoSeleccionado"])||isset($_POST["btnEditarNota"]) || isset($_POST["btnBorrarNota"])) { // por aqui lo dejamos

            echo "<h2>Notas del Alumno " . $nombre_alumno_seleccionado  . "</h2>";
            echo "<table class='table'>";
            echo "<tr><th>Asignaturas</th><th>Notas</th><th>Accion</th></tr>";

            foreach ($notas_Alumno as $tupla) {
                echo "<tr>";
                echo "<td>" . $tupla["denominacion"] . "</td>";
                echo "<td>" . $tupla["nota"] . "</td>";
                echo "<td><form action='index.php' method='post'>";
                echo "<input type='hidden' name='alumnoSeleccionado' value='" . $_POST["alumnoSeleccionado"] . "'>";
                echo "<input type='hidden' name='cod_asig' value='" . $tupla["cod_asig"] . "'>";
                if((isset($_POST["btnEditarNota"])||isset($_POST["btnCambiarNota"])) && $_POST["cod_asig"]== $tupla["cod_asig"])
                {
                    if(isset($_POST["btnEditarNota"]))
                    echo "<input class='editarNota' type='text' name='nota' value='".$tupla["nota"]."'>";
                    else
                    echo "<input class='editarNota' type='text' name='nota' value='".$_POST["nota"]."'>";
                    echo "<span class='error'>*No has introducido un valor válido de nota*</span></br>";
                    echo "</td>";
                    echo"<td>";
                    echo "<button class='enlace' name='btnCambiarNota' type='submit'>Cambiar</button>-<button class='enlace' name='btnAtras' type='submit'>Atras</button>";
                    echo"</td>";
                }                                                              
                                
                 else {
                    echo "<button class='enlace' name='btnEditarNota' type='submit'>Editar</button>-<button class='enlace' name='btnBorrarNota' type='submit'>Borrar</button>";
                }
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }


            echo "</table>";
            if (isset($_SESSION["mensaje_accion"])) {
                echo "<p class='mensaje'>" . $_SESSION["mensaje_accion"] . "</p>";
                unset($_SESSION["mensaje_accion"]);
            }
        }
        if(count($datos_Asig_NO_Evau)>0)
        {

            echo "<p>";
            echo "<form action='index.php' method='post'>";
            echo "<label for='asignaturas'>Asignaturas que a <strong> " . $nombre_alumno_seleccionado . " </strong> aún le queda por calificar </label>";
            echo "<input type='hidden' name='alumnoSeleccionado' value='" . $_POST["alumnoSeleccionado"] . "'>";
            echo "<select for='asignaturas' name='asignaturas'>";
            foreach ($datos_Asig_NO_Evau as $tupla) {
                echo "<option value='" . $tupla["cod_asig"] . "'>" . $tupla["denominacion"] . "</option>";
            }
            echo "</select>";
            echo " <button name='btnCalificar' type='submit'>Calificar</button>";
            echo "</form>";
            echo "</p>";

        }
        else
        {
            echo "<p>A " . $nombre_alumno_seleccionado . " no quedan asignaturas por calificar</p>";
        }
        ?>
        </div>
    <?php
    }   
                  
    ?>
    <div>
</body>

</html>