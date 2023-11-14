<?php
    $usuario=$_REQUEST["usuario"];
    $codigo=$_REQUEST["clave"];

    $usuVal="admi";
    $claveVal="1234";

   if($usuario==$usuVal && $codigo==$claveVal){
   return "USUARIO VALIDOaaaaaaa";

   }else{
   return "USUARIO NO VALIDaaaaaaO";
   }
    
  


?>