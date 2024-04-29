<?php
session_name("Pract2_libreria_Exam_23_24");
session_start();
require "src/funciones_ctes.php";

if(isset($_POST["btnSalir"]))
{
    session_destroy();
    header("Location:index.php");
    exit();
}


if(isset($_SESSION["usuario"]))
{
    
    require "src/seguridad.php";

    if($datos_usuario_log["tipo"]=="normal")
        
        require "vistas/vista_normal.php";
    else
        header("Location:admin/gest_libros.php");
      //  session_destroy();
        exit();

 
    $conexion=null;
}
else
{
    require "vistas/vista_home.php";
}




