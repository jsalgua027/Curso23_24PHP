<?php
session_name("Examen_guardias_24");
session_start();

require "src/funciones_cstes.php";

if(isset($_SESSION["usuario"]))
{
    require "src/seguridad.php";
    if($datos_usuario_log->rowCount()>0)
    {
        require "vistas/vista_home.php";
    }
}
else
{
    require "vistas/vista_login.php";
}

?>
