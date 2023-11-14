<?php

    $usuario=$_REQUEST["usuario"];
    $codigo=$_REQUEST["clave"];

 
 function valido($a,$v){
    $usuVal="admi";
    $claveVal="1234";
    if($a==$usuVal && $v==$claveVal){
     echo"USUARIO VALIDO";
 
    }else{
    echo "USUARIO NO VALIDO";
    }}
   valido($usuario,$codigo);
  
 

?>