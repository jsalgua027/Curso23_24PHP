<?php
session_name("Examen3_17_18");
session_start();


//si estoy logeado
if(isset($_SESSION["usuario"]))
{
            //estoy logeado
          require("src/seguridad.php");  
        // segurida control de logeo y de tiempo

       //vista oportuna


}

else{
            //no estoy logeado y no he pulsado el boton logeado
            //vista inicio o home
    require("vistas/vista_home.php");
    if(isset($_POST["btnRegistrarse"])){
        header("Location:vistas/registro_usuario.php");
        exit;
    }


}


?>