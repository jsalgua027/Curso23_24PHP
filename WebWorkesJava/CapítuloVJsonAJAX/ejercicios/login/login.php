<?php
    $usuario=$_REQUEST["usuario"];
    $codigo=$_REQUEST["clave"];

    $usuVal="admi";
    $claveVal="1234";

   if($usuario==$usuVal && $codigo==$claveVal){
   return "USUARIO VALIDO";

   }else{
   return "USUARIO NO VALIDO";
   }
    
  


?>