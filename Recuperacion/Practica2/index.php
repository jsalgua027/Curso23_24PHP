<?php
session_name("practica2_recu");
session_start();
//$_SESSION["usuario"];

if(isset($_SESSION["usuario"]))
{
require("./vistas/usuario_logeado.php");

}
else{
    require("./vistas/vista_login.php");

}





// ciero la sesión
session_destroy();



?>