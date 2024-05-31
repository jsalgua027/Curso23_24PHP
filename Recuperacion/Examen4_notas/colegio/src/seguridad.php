<?php
// recojo la clave api de mi session  para usarlo en logueado

$datos_env=$_SESSION["api_session"];
// le paso el logueado
$repuesta=consumir_servicios_REST(DIR_SERV."/logueado", "GET",$datos_env)


?>