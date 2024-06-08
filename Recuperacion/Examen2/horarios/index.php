<?php
session_name("Examen2_SW");
session_start();
require "src/funciones_ctes.php";


// obtengo a todos los usuarios
$respuesta = consumir_servicios_REST(DIR_SERV . "/profesores", "GET");
$json = json_decode($respuesta, true);
if (!$json) {
    session_destroy();
    die(error_page("Examen 2 Horarios", "<h1>Examen 2 Horarios</h1><p>Sin respuesta oportuna de la API notasAlumno</p>"));
}
if (isset($json["error"])) {

    session_destroy();
    consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos_env);
    die(error_page("Examen 2 Horarios", "<h1>Examen 2 Horarios</h1><p>" . $json["error"] . "</p>"));
}
// si el alumno no tiene notas lo controlo aqui


$usuarios = $json["usuarios"];

if (isset($_POST["btnQuitar"])){
    $datos_env["grupo"]=$_POST["grupoQuitar"];
    $datos_env["dia"]=$_POST["diaQuitar"];
    $datos_env["hora"]=$_POST["horaQuitar"];
    $usuario=$_POST["usuarios"];



   

   $respuesta = consumir_servicios_REST(DIR_SERV . "/quitarGrupo/" . $usuario, "DELETE", $datos_env);
   $json = json_decode($respuesta, true);
  
   if (!$json) {
       session_destroy();
       die(error_page("Examen 2 Horarios", "<h1>Examen 2 Horarios</h1><p>Sin respuesta oportuna de la API Quitar Grupo</p>"));
   }
   if (isset($json["error"])) {

       session_destroy();
       consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos_env);
       die(error_page("Examen 2 Horarios", "<h1>Examen 2 Horarios</h1><p>" . $json["error"] . "</p>"));
   }


        $_SESSION["mensaje_accion"]="¡¡ Grupo Eliminado con exito !!";
        $_SESSION["usuarios"]=$_POST["usuarios"];
        header("Location:index.php");
        exit;

}

if(isset($_SESSION["usuarios"]))
{
    $_POST["usuarios"]=$_SESSION["usuarios"];
    unset($_SESSION["usuarios"]);
}



if (isset($_POST["usuarios"])) {
    $usuario = $_POST["usuarios"];
    $respuesta = consumir_servicios_REST(DIR_SERV . "/horarios/" . $usuario . "", "GET");
    $json = json_decode($respuesta, true);
    if (!$json) {
        session_destroy();
        die(error_page("Examen 2 Horarios", "<h1>Examen 2 Horarios</h1><p>Sin respuesta oportuna de la API notasAlumno</p>"));
    }
    if (isset($json["error"])) {

        session_destroy();
        consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos_env);
        die(error_page("Examen 2 Horarios", "<h1>Examen 2 Horarios</h1><p>" . $json["error"] . "</p>"));
    }

    $horarios_profesor = $json["horarios"];
    // var_dump($horarios_profesor);
 
}
if (isset($_POST["btnEditar"])) {

    $datos_env["dia"] = $_POST["dia"];
    $datos_env["hora"] = $_POST["hora"];
    $usuario = $_POST["usuarios"];
  

    $respuesta = consumir_servicios_REST(DIR_SERV . "/obtenerGrupos/" . $usuario, "GET", $datos_env);
    $json = json_decode($respuesta, true);
    //var_dump($json);
    if (!$json) {
        session_destroy();
        die(error_page("Examen 2 Horarios", "<h1>Examen 2 Horarios</h1><p>Sin respuesta oportuna de la API obtener grupos</p>"));
    }
    if (isset($json["error"])) {

        session_destroy();
        consumir_servicios_REST(DIR_SERV . "/salir", "POST", $datos_env);
        die(error_page("Examen 2 Horarios", "<h1>Examen 2 Horarios</h1><p>" . $json["error"] . "</p>"));
    }
    $grupos = $json["grupos"];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 PHP</title>
    <style>
        table,
        td,
        th {
            border-collapse: collapse;
            border: 1px solid black;
            text-align: center;
            width: 500px;
        }

        th {
            background-color: gray;
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }
        .segunda
        {
            width: 500px;
        }
    </style>
</head>

<body>
    <h1>Examen2 PHP</h1>
    <h2>Horario de los Profesores</h2>
    <form action="index.php" method="post">
        <select id="usuarios" name="usuarios">
            <?php
            foreach ($usuarios as $tupla) {
                if (isset($_POST["usuarios"]) && $_POST["usuarios"] == $tupla["id_usuario"]) {
                    echo "<option selected value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>";
                    $nombre_profesor = $tupla["nombre"];
                } else {
                    echo "<option value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>";
                }
            }
            ?>
        </select>
        <button type="submit" name="btnVerHorario">Ver Horario</button>
    </form>

    <?php
    // horas
    $horas[1] = "8:15-9:15";
    $horas[2] = "9:15-10:15";
    $horas[3] = "10:15-11:15";
    $horas[4] = "11:15-11:45"; //recreo
    $horas[5] = "11:45-12:45";
    $horas[6] = "12:45-13:45";
    $horas[7] = "13:45-14:45";
    //días
    $dias[1] = "Lunes";
    $dias[2] = "Martes";
    $dias[3] = "Miercoles";
    $dias[4] = "Jueves";
    $dias[5] = "Viernes";


    if (isset($_POST["usuarios"])) {
        echo "<h2>El horario del profesor " . $nombre_profesor . " </h2>";

        echo "<table>";
        echo "<tr><th></th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th></tr>";
        for ($hora = 1; $hora <= 7; $hora++) {
            echo "<tr>";
            echo "<td>" . $horas[$hora] . " </td>";
            if ($hora == 3) {
                echo "<td colspan='5'>RECREO</td>";
            } else {
                for ($dia = 1; $dia <= 5; $dia++) {


                    echo "<td>";
                    foreach ($horarios_profesor as $tupla) {
                        echo "<form action='index.php' method='post'>";
                        if ($tupla["dia"] == $dia && $tupla["hora"] == $hora) {
                            echo $tupla['nombre'] . "<br/>";
                        }
                    }

                    echo "<input type='hidden' name='dia' value='" . $dia . "'/>";
                    echo "<input type='hidden' name='hora' value='" . $hora . "'/>";
                    echo "<input type='hidden' name='usuarios' value='" . $_POST["usuarios"] . "'/>";
                    echo "<br/><button class='enlace' type='submit' name='btnEditar'>Editar</button>";
                    echo "</form>";
                    echo "</td>";
                }
            }

            echo "</tr>";
        }

        echo "</table>";
    }
    if (isset($_POST["btnEditar"])|| isset($_POST["btnQuitar"])) {


        $dia = $_POST["dia"];
        $hora = $_POST["hora"];
        $usuario = $_POST["usuarios"];
        echo "<h3>Editando la " . $hora . " hora de  (" . $horas[$hora] . ") del " . $dias[$dia] . "</h3>";

        if(count($grupos)>0){
            echo "<table class='segunda'>";
            echo"<tr><th>Grupo</th><th>Acción</th></tr>";
            foreach($grupos as $tupla)
            {
                echo"<tr>";
                echo"<td>".$tupla["nombre"]."</td>";
                echo"<td> <form action='index.php' method='post'><button class='enlace' type='submit' name='btnQuitar'>Quitar</button>";
                echo "<input type='hidden' name='usuarios' value='" . $tupla["usuario"] . "'/>";
                echo "<input type='hidden' name='grupoQuitar' value='" . $tupla["id_grupo"] . "'/>";
                echo "<input type='hidden' name='diaQuitar' value='" . $tupla["dia"] . "'/>";
                echo "<input type='hidden' name='horaQuitar' value='" . $tupla["hora"] . "'/>";
                echo"</form>";
                echo "</td>";
                echo"</tr>";
            }
            echo "</table>";
        }
        else
        {
            echo "<table class='segunda'>";
            echo"<tr><th>Grupo</th><th>Acción</th></tr>";
            echo "</table>";
        }
      
        

    }

    if(isset($_SESSION ["mensaje_accion"]))
            {
                echo "<p class='mensaje'>".$_SESSION ["mensaje_accion"]."</p>";
                unset($_SESSION["mensaje_accion"]);
            }


    ?>
  
</body>

</html>