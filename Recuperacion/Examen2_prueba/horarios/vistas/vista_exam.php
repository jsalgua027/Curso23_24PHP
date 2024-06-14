<?php
if (isset($_POST["btnVerHorario"])||isset($_POST["btnEditar"])) {
    $usuario = $_POST["profesores"];
    $respuesta = consumir_servicios_REST(DIR_SERV . "/horario/" . $usuario, "GET", $datos_env);
    $json = json_decode($respuesta, true);
    //que no llegue nada
    if (!$json) {
        session_destroy();
        die(error_page("<h1>Examen 2 PRUEBA</h1>", "<p>Error al consumir los servicios de la API Horario profesor<p>"));
    }
    //que llegue el mensaje de error
    if (isset($json["error"])) {
        session_destroy();
        consumir_servicios_REST(DIR_SERV."/salir","POST",$datos_env);
        die(error_page("<h1>Examen 2 PRUEBA</h1>", "<p>Error al " . $json["error"] . "<p>"));
    }
    if(isset($json["no_auth"]))
    {
        session_unset();
        $_SESSION["seguridad"]="Usted ha dejado de tener acceso a la API. Por favor vuelva a loguearse.";
        header("Location:index.php");
        exit();
    }

      $horario = $json["horarios_profesor"];
    
  
    foreach ($json["horarios_profesor"] as $tupla)
     {
        if(isset($h_profesor[$tupla["dia"]][$tupla["hora"]])) {
            $h_profesor[$tupla["dia"]][$tupla["hora"]] .= $tupla["nombre"];
        } else {
            $h_profesor[$tupla["dia"]][$tupla["hora"]]= $tupla["nombre"];
        }
    }
}

if(isset($_POST["btnEditar"]))
{
  
    $dia=$_POST["dia"];
    $hora=$_POST["hora"];
    $profe=$_POST["profesores"];

   

    $respuesta = consumir_servicios_REST(DIR_SERV . "/GruposDia/".$dia."/".$hora."/".$profe."", "GET", $datos_env);
$json = json_decode($respuesta, true);
if (!$json) {
    session_destroy();
    die(error_page("<h1>Examen 2 PRUEBA</h1>", "<p>Error al consumir los servicios de la API Horario profesor<p>"));
}
//que llegue el mensaje de error
if (isset($json["error"])) {
    session_destroy();
    consumir_servicios_REST(DIR_SERV."/salir","POST",$datos_env);
    die(error_page("<h1>Examen 2 PRUEBA</h1>", "<p>Error al " . $json["error"] . "<p>"));
}
if(isset($json["no_auth"]))
{
    session_unset();
    $_SESSION["seguridad"]="Usted ha dejado de tener acceso a la API. Por favor vuelva a loguearse.";
    header("Location:index.php");
    exit();
}
$gruposProfe=$json["grupos_profe"];

}

$respuesta = consumir_servicios_REST(DIR_SERV . "/profesores", "GET", $datos_env);
$json = json_decode($respuesta, true);
if (!$json) {
    session_destroy();
    die(error_page("<h1>Examen 2 PRUEBA</h1>", "<p>Error al consumir los servicios de la API Horario profesor<p>"));
}
//que llegue el mensaje de error
if (isset($json["error"])) {
    session_destroy();
    consumir_servicios_REST(DIR_SERV."/salir","POST",$datos_env);
    die(error_page("<h1>Examen 2 PRUEBA</h1>", "<p>Error al " . $json["error"] . "<p>"));
}
if(isset($json["no_auth"]))
{
    session_unset();
    $_SESSION["seguridad"]="Usted ha dejado de tener acceso a la API. Por favor vuelva a loguearse.";
    header("Location:index.php");
    exit();
}

$profesores = $json["profesores"];

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
        }

        table {
            border-collapse: collapse;
            text-align: center
        }

        th {
            background-color: #CCC
        }
    </style>
</head>

<body>
    <h1>Examen2 PHP</h1>
    <h2>Horarios de Profesores</h2>

    <form action="index.php" method="post">
        <label for='profesores'></label>
        <select name="profesores" id="profesores">
            <?php
            foreach ($profesores as $tupla) {
                if (isset($_POST["profesores"]) && $_POST["profesores"] == $tupla["id_usuario"]) {
                    echo "<option selected value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>";
                    $nombre_profesor = $tupla["nombre"];
                } else
                    echo "<option value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</option>";
            }
            ?>
        </select>
        <button type="submit" name='btnVerHorario'>Ver Horario</button>
    </form>

    <?php
    if (isset($_POST["btnVerHorario"]) || isset($_POST["btnEditar"])) {
        echo "<h2>El horario del Profesor: " . $nombre_profesor . "</h2>";

        $horas[1]="8:15 - 9:15";
        $horas[2]="9:15 - 10:15";
        $horas[3]="10:15 - 11:15";
        $horas[4]="11:15 - 11:45";
        $horas[5]="11:45 - 12:45";
        $horas[6]="12:45 - 13:45";
        $horas[7]="13:45 - 14:45";

        $dias[]="";
        $dias[]="Lunes";
        $dias[]="Martes";
        $dias[]="Miércoles";
        $dias[]="Jueves";
        $dias[]="Viernes";

        echo"<table>";
        echo "<tr>";
        for ($i=0; $i <count($dias) ; $i++) { 
            echo "<th>".$dias[$i]."</th>";
        }
        echo "</tr>";
        for($hora=1;$hora<=count($horas);$hora++)
        {
            echo "<tr>";
            echo "<th>".$horas[$hora]."</th>";
            if($hora==4)
            {
                echo "<td colspan='5'>RECREO</td>";
            }
            else
            {
                for($dia=1;$dia<count($dias); $dia++)
                {
                    echo "<td>";
                    if(isset($h_profesor[$dia][$hora]))
                        echo $h_profesor[$dia][$hora];
                
                    echo "<form action='index.php' method='post'>";
                    echo "<input type='hidden' name='dia' value='".$dia."'/>";
                    echo "<input type='hidden' name='hora' value='".$hora."'/>";
                    echo "<input type='hidden' name='profesores' value='".$_POST["profesores"]."'/>";
                    echo "<button class='enlace' type='submit' name='btnEditar'>Editar</button>";
                    echo "</form>"; 
                    echo "</td>";
                }
            }
            
            echo "</tr>";
        }
        echo"</table>";
      
    }

    if(isset($_POST["btnEditar"]))
    {
  echo"<h2>Editando la ".$_POST["hora"]."º Hora (".$horas[$_POST["hora"]].") del ".$dias[$_POST["dia"]]."</h2>";
  
echo"<table>";
echo"<tr><th>Grupo</th><th>Acción</th></tr>";

  foreach($gruposProfe as $tupla)
  {
      echo"<tr>";
      echo"<td>".$tupla["nombre"]."</td>";
      echo"<td>";
      echo "<form action='index.php' method='post'>";
      echo "<input type='hidden' name='dia' value='".$_POST["dia"]."'/>";
      echo "<input type='hidden' name='hora' value='".$_POST["hora"]."'/>";
      echo "<input type='hidden' name='profesores' value='".$_POST["profesores"]."'/>";
       echo "<input type='hidden' name='btnEditar' value=''/>";
      echo "<button class='enlace' type='submit' name='btnQuitar'>Quitar</button>";
      echo "</form>"; 
      echo "</td>";
      echo"</tr>";
  }

echo"</table>";

    }
 if(isset($_POST["btnQuitar"]))
 {
 echo "<p> el dia es:".$_POST["dia"]."</p>";
 echo "<p> el hora es: ".$_POST["hora"]."</p>";
 echo "<p> el el usuario es: ".$_POST["profesores"]."</p>";


 } 


    ?>


</body>

</html>