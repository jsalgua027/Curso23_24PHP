<?php
session_name("Examen3_17_18");
session_start();
require("src/ctes_func.php");//llamo a las costantes creadas y al metedo repetido


if(isset($_POST["btnSalir"])){// si le damos al boton de salir de vista examen destruyo la sesiion y bolvemos al index
  session_destroy();
  header("Location:index.php");
  exit;
}

//si estoy logeado
if(isset($_SESSION["usuario"]))
{
            //estoy logeado
              // segurida control de logeo y de tiempo
          require("src/seguridad.php");  
      

       //vista oportuna
       require("vistas/vista_examen.php");  
       mysqli_close($conexion);



}

else{
            //no estoy logeado y no he pulsado el boton logeado
            //vista inicio o home
    require("vistas/vista_login.php");
 

}


?>