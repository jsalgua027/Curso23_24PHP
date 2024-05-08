<?php

  $api_key["api_key"]=$_SESSION["api_key"];// me traigo el codigo
  $respuesta=consumir_servicios_REST(DIR_SERV,"/logueado","POST",$api_key);
  // compruebo lo que recibo
  $json=json_decode($respuesta,true);
  if(!$json)
  {
      session_destroy();
      die(error_page("Práctica Rec 2","<h1>Práctica Rec 2</h1><p>Sin respuesta oportuna de la API</p>"));

  }
  // pregunto por el tipo de json

  if(isset($json["error_bd"])) // si recibo el mensaje de erro
  {
      session_destroy();
      die(error_page("Práctica Rec 2","<h1>Práctica Rec 2</h1><p>".$json["error_bd"]."</p>"));

  }

  if(isset($json["no_auth"])) // si recibo el mensaje  de no autorizado
  {
    session_unset();
    $_SESSION["seguridad"]="Usted ha dejado de tener acceso a la Api. Por favor vuelva a loguearse";
    header("Location:index.php");
    exit();
  }

 if(isset($json["mensaje"]))
{
      
        session_unset();
        $_SESSION["seguridad"]="Usted ya no se encuentra registrado en la BD";
        header("Location:index.php");
        exit();
}
// Acabo de pasar el control de baneo
$datos_usuario_log=$json["usuario"];

//Ahora paso el control de tiempo

if(time()-$_SESSION["ultm_accion"]>MINUTOS*60)
{
    $conexion=null;
    session_unset();
    $_SESSION["seguridad"]="Su tiempo de sesión ha expirado. Por favor vuelva a loguearse";
    header("Location:index.php");
    exit();
}
// Paso el control de tiempo y lo renuevo
$_SESSION["ultm_accion"]=time();
?>