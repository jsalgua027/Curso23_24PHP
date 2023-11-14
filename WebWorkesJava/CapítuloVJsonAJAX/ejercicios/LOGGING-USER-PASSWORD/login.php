<?php
$arr=["admin"=>"1234"];

//primero recogemos el parametro de la URL
$param1=$_REQUEST["usuario"];
$param2=$_REQUEST["clave"];

function esUsuarioValido($param1,$param2,$arr){
 $resultado=false;

 //si esta vacio, y si es igual a 

 foreach ($arr as $key => $value) {
  
    if($param1==$key && $param2==$value){
       return $resultado=true;
    }

 }


return $resultado;

}

$resultado=esUsuarioValido($param1,$param2, $arr);

 echo ($resultado)? "USUARIO VÁLIDO" :"USUARIO NO VÁLIDO";



?>