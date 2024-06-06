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
        }

        th {
            background-color: gray;
        }
        .enlace{border:none;background:none;color:blue;text-decoration:underline;cursor:pointer}
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
    $horas[0] = "8:15-9:15";
    $horas[1] = "9:15-10:15";
    $horas[2] = "10:15-11:15";
    $horas[3] = "11:15-11:45"; //recreo
    $horas[4] = "11:45-12:45";
    $horas[5] = "12:45-13:45";
    $horas[6] = "13:45-14:45";
    //días
    $dias[0] = "Lunes";
    $dias[1] = "Martes";
    $dias[2] = "Miercoles";
    $dias[3] = "Jueves";
    $dias[4] = "Viernes";


    if (isset($_POST["usuarios"])) {
        echo "<h2>El horario del profesor " . $nombre_profesor . " </h2>";
        echo "<form action='index.php' method='post'>";
        echo "<table>";
        echo "<tr><th></th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th></tr>";
        for ($hora = 0; $hora <= 6; $hora++) {
            echo "<tr>";
            echo "<td>" . $horas[$hora] . " </td>";
            if ($hora == 3) {
                echo "<td colspan='5'>RECREO</td>";
            } else {
                for ($dia = 0; $dia <= 4; $dia++) {
                    echo "<td>";
                    foreach ($horarios_profesor as $tupla)
                     {
                        if ($tupla["dia"] == $dia && $tupla["hora"] == $hora)
                            echo $tupla['nombre']."<br/>";
                            echo "<input type='hidden' name='dia' value='".$tupla["dia"]."'/>";
                            echo "<input type='hidden' name='hora' value='".$tupla["hora"]."'/>";
                            echo "<input type='hidden' name='usuarios' value='".$tupla["hora"]."'/>";
                    }
                    echo "<br/><button class='enlace' type='submit' name='btnEditar'>Editar</button>";
                    echo "</td>";
                }
            }

            echo "</tr>";
        }
        echo "</table>";
        echo "</form>";
    }
    if (isset($_POST["btnEditar"])) 
    {

        $dia = $_POST["dia"];
        $hora = $_POST["hora"];
        $usuario = $_POST["usuarios"];
    
      
    
        echo "<h3>Editando la ".$hora." " . $horas[$hora] . " del " . $dias[$dia] . "</h3>";
    }
    ?>
</body>

</html>