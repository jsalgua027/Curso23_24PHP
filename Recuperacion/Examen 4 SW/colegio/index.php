<?php
session_name("Examen_4_SW");
session_start();

//si el usuario es tipo tutor
if($_SESSION["usuario"])
{
//seguridad
require "src/seguridad.php";
if($datos_usu["tipo"]=="alumno")
{
    //vista alumno
    require "vitas/vista_normal.php";

}
else//sino 
{
//vista_tutor
header("Location:admin/index.php");
exit;
}

}



require "vistas/vista_login.php";
?>