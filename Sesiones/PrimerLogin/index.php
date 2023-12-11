<?php
session_name("Primer_login_23_24");
session_start();
require "src/func_ctes.php";
// si existe el boton salir destruyo la sesion
if (isset($_POST["btnSalir"])) {

    session_destroy();
    header("Location:index.php");
}


if (isset($_SESSION["user"])) {
    

    //ha pasado los dos controles
    require "src/seguridad.php";



    if($datos_usuario_resultado["tipo"]=="admin"){

        require "vistas/vista_admin.php";
    }else{

        require "vistas/vista_normal.php";
    }
   
    mysqli_close($conexion);


} else {
    require "vistas/vista_login.php";
}
