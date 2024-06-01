<?php
session_name("Examen_4_SW");
session_start();
require "../src/func_ctes.php";
require "../src/seguridad.php";

$respuesta=consumir_servicios_REST(DIR_SERV."/alumnos","GET",$datos_env);
$json=json_decode($respuesta,true);
if(!$json)
{
    session_destroy();
    die(error_page("Examen 4 Notas","<h1>Examen 4 Notas</h1><p>Sin respuesta oportuna de la API</p>"));  
}
if(isset($json["error"]))
{

    session_destroy();
    consumir_servicios_REST(DIR_SERV."/salir","POST",$datos_env);
    die(error_page("Examen 4 Notas","<h1>Examen 4 Notas</h1><p>".$json["error"]."</p>"));
}

if(isset($json["no_auth"]))
{
   session_unset();
   $_SESSION["seguridad"]="Usted ha dejado de tener acceso a la API. Por favor vuelva a loguearse.";
   header("Location:index.php");
   exit();
}

$todos_alumnos=$json["alumnos"];



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .en_linea{display:inline}
        .enlace{border:none;background:none;color:blue;text-decoration:underline;cursor:pointer}
        .mensaje{font-size:1.25em;color:blue}
    </style>
</head>
<body>
    <h1>Notas de los Alumnos: Vista Tutor</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log["usuario"];?></strong> - 
        <form class="en_linea" action="../index.php" method="post">
            <button class="enlace" name="btnSalir" type="submit">Salir</button>
        </form>
    </div>

    <div>
       
        <form class="en_linea" action="index.php" method="post">
            <p>
                <label for="seleccion">Seleccione a un alumno</label>
                <select  for="alumnos" name="alumnos">
                    <?php
                    foreach($todos_alumnos as $tupla)
                    {
                        echo"<option value='".$tupla["cod_usu"]."'>".$tupla["nombre"]."</option>";
                    }
                    ?>
                  
                </select>
                <button  name="btnVerNotas" type="submit">Ver Notas</button>
            </p>
            
        </form>
    </div>
</body>
</html>