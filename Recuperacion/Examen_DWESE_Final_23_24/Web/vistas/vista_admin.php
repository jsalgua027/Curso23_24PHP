<?php
if(isset($_POST["btnVerHorario"]))
{
    $id_grupo=$_POST["grupos"];

    $respuesta=consumir_servicios_REST(DIR_SERV."/horarioGrupo/".$id_grupo."","GET",$datos_env);
    $obj=json_decode($respuesta,true);
    if(!$obj)
    {
        session_destroy();
        die(error_page("Examen Final PHP","<h1>Examen Final PHP</h1><p>Error consumiendo el servicio: Horarios Grupos</p>"));
    }
    
    if(isset($obj["error"]))
    {
        session_destroy();
        die(error_page("Examen Final PHP","<h1>Examen Final PHP</h1><p>".$obj["error"]."</p>"));
    }
    
    $horarios_grupo=$obj["horario"];
    
    
    

}




$respuesta=consumir_servicios_REST(DIR_SERV."/todosGrupos","GET",$datos_env);
$obj=json_decode($respuesta,true);
if(!$obj)
{
    session_destroy();
    die(error_page("Examen Final PHP","<h1>Examen Final PHP</h1><p>Error consumiendo el servicio: Horarios Profeso </p>"));
}

if(isset($obj["error"]))
{
    session_destroy();
    die(error_page("Examen Final PHP","<h1>Examen Final PHP</h1><p>".$obj["error"]."</p>"));
}

$grupos=$obj["grupos"];



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Final PHP</title>
    <style>
        .en_linea{display:inline}
        .enlace{border:none;background:none;color:blue;text-decoration:underline;cursor:pointer}
        .mensaje{font-size:1.25em;color:blue}
        table,th, td{border:1px solid black;}
        table{border-collapse:collapse;text-align:center}
        th{background-color:#CCC}
    </style>
</head>
<body>
    <h1>Examen Final PHP</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log["usuario"];?></strong> - 
        <form class="en_linea" action="index.php" method="post">
            <button class="enlace" name="btnSalir" type="submit">Salir</button>
        </form>
    </div>
    
    <form action="index.php" method="post">
        <p>
            <?php
         echo"<select name='grupos' id='grupos'>"; 
      
            foreach($grupos as $tupla)
            {
             echo"<option value='".$tupla["id_grupo"]."'>".$tupla["nombre"]."</option>";   

            }
               
            
          echo "</select>";
          echo "<button name='btnVerHorario' value=''>Ver Horario</button>";
         ?>
        </p>

    </form>

    <?php
    if(isset($_POST["btnVerHorario"])){

        $dias[1]="Lunes";
        $dias[2]="Martes";
        $dias[3]="Miercoles";
        $dias[4]="Jueves";
        $dias[5]="Viernes";
        
        $horas[1]="8:15-9:15";
        $horas[2]="9:15-10:15";
        $horas[3]="10:15-11:15";
        $horas[4]="11:15-11:45";
        $horas[5]="11:45-12:45";
        $horas[6]="12:45-13:45";
        $horas[7]="13:45-14:45";
    
        echo "<table>";
        echo "<tr><th></th><th>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th></tr>";
        for ($hora=1; $hora <=7 ; $hora++) { 
            
           echo "<tr>";
                echo "<td>".$horas[$hora]."</td>";
                if($hora==4)
                {
                    echo "<td colspan='5'>RECREO</td>";
                }
                else
                {
                    for ($dia=1; $dia <=5 ; $dia++) { 
                        echo "<td>"; 
                        if(!isset($horarios_grupo[$dia]["nombre"])||!($horarios_grupo[$dia]["nombre"]))
                        {
                            echo"";
                        }
                        else{
                            echo"".$horarios_grupo[$hora]["nombre"]."<br/>";
                          
                        }
                          
                                                                                       
    
                        echo "</td>";
                    }
                }
               
            echo "<tr>";
        }
        echo "<table>";

    }
   
    
    
    ?>
   
</body>
</html>