<?php
    $usuario=$_REQUEST["usuario"];
    $clave=$_REQUEST["clave"];

    $usuVal="adim";
    $claveVal="1234";

   if($usuario==$usuVal && $clave==$claveVal){
    echo"USUARIO VALIDO";

   }else{
    echo"USUARIO NO VALIDO";
   }




?>