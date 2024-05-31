<?php
session_name("Examen_4_SW");
session_start();
 require "src/func_ctes.php";
//si el usuario es tipo tutor
if(isset($_SESSION["usuario"]))
{
//seguridad
require "src/seguridad.php";
if($datos_usuario_log["tipo"]=="alumno")
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