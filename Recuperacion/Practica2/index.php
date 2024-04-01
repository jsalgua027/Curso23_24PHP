<?php
session_name("practica2_recu");
session_start();
//$_SESSION["usuario"];
require "src/ctes_func.php";

if(isset($_SESSION["usuario"]))
{
    if($datos_usuario_logeado["tipo"]=="normal") // si el usuario es normal
    {
        require "vistas/vista_normal.php";
    }
   else{ // si el usuario es admin
    require "vistas/vista_admin.php";

   }

}
else{
   //cargo inicialmemnte el login si no existe la sesión
    require "vistas/vista_login.php";
  

}





// ciero la sesión
//session_destroy();



?>