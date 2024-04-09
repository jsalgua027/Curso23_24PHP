<?php



session_name("Practica2A_rec");
session_start();
require "src/ctes_funciones.php";

if (isset($_POST["btnSalir"])) {
    session_destroy();
    header("Location:index.php");
    exit;
}


if(isset($_SESSION["usuario"]))
{
    //si esta logeado por aqui
    // realizo la seguridad del logeo
   require "src/seguridad.php";
   if($datos_usuario_logeado["tipo"]=="admin")
   {
   
    require "vistas/vista_admin.php";
   }
   else
   {
    require "vistas/vista_normal.php";
   }
   $conexion=null;//porque con  seguridad se inicia lo conexion
}
elseif(isset($_POST["btnRegistro"]) ||isset($_POST["btnNuevoRegistro"]) || isset($_POST["btnBorrarDatos"]))
{
 require "vistas/vista_registro.php";
}
else
{
    //si no esta logeado
    require "vistas/vista_login.php";

}



?>