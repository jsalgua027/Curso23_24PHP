<?php
if (isset($_POST["btnEquipo"]))
{
      
    if($_POST["hora"]>3)
    {
       $hora=($_POST["hora"])-1;
    }
    else
    {
        $hora=($_POST["hora"]);
    }
   
   

    $datos_env["dia"]=$_POST["dia"];
    $datos_env["hora"]=$_POST["hora"];
    $datos_env["usuario"]=$datos_usuario_log["id_usuario"];
    echo"<p>la hora es :  ".$datos_env["dia"]."</p>";
    echo"<p>el dia  es :  ".$datos_env["hora"]."</p>";
    echo"<p>el usuario es :  ".$datos_env["usuario"]."</p>";
    

    $respuesta=consumir_servicios_REST(DIR_SERV."/deGuardia","GET",$datos_env);
    $json=json_decode($respuesta,true);
   echo"<p>la resuesta es :  ".$json."</p>";


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
            text-align: center;
        }

        th {
            background-color: gray;
        }
    </style>
</head>
<body>
   <h1>Gestión de guardias</h1>
    <form action="index.php" method="post">
        <p>Bienvenido <?php echo "".$datos_usuario_log["usuario"].""?>
        <button class="enlace" type="submit" name="btnSalir">Salir</button></p>
    </form>
<?php
    $dias[1]="Lunes";
    $dias[2]="Martes";
    $dias[3]="Miercoles";
    $dias[4]="Jueves";
    $dias[5]="Viernes";

    $horas[1]="1ºHora";
    $horas[2]="2ºHora";
    $horas[3]="3ºHora";
    $horas[4]="";
    $horas[5]="4ºHora";
    $horas[6]="5ºHora";
    $horas[7]="6ºHora";
        $numero=1;
        echo "<table>";
        echo "<tr><th></th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th></tr>";
        
        for ($hora=1; $hora <8 ; $hora++) { 
           
         echo"<tr>";
         echo "<td>" . $horas[$hora] . " </td>";
         if ($hora == 4) {
           
             echo "<td colspan='5'>RECREO</td>";
         } else {
            for ($dia=1; $dia< 6 ; $dia++) { 
                echo"<td>";
                echo "<form action='index.php' method='post'><button class='enlace' type='submit' name='btnEquipo'>Equipo ".$numero."</button>";
                 echo"<input type='hidden' name='dia' value='".$dia."'/>";
                 echo"<input type='hidden' name='hora' value='".$hora."'/>";
                 echo"<input type='hidden' name='numero' value='".$numero."'/>";
                echo"</form>";
                echo"</td>";
                $numero++;
             }
             echo"</tr>";
            
         }
         
        }
            
        echo "</table>";

        if(isset($_POST["btnEquipo"]))
        {
            echo"<h2>EQUIPO DE GUARDIA ".$_POST["numero"]."</h2>";
            echo "<h3>".$dias[$_POST["dia"]]." a ".$horas[$_POST["hora"]]."</h3>";


        }


?>

</body>
</html>