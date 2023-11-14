<?php 
//CTES base de datos

define("SERVIDOR_BD","localhost");
define("USUARIO_BD","jose");
define("CLAVE_BD","josefa");
define("NOMBRE_BD","bd_foro");



function error_page($title,$body)
{
    $page='<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>'.$title.'</title>
    </head>
    <body>'.$body.'</body>
    </html>';
    return $page;
}

function repetido($conexion,$tabla,$columna,$valor)
{
 //REALIZO LA CONSULTA
    try{
        $consulta="select * from ".$tabla." where ".$columna."='".$valor."'";
        $resultado=mysqli_query($conexion, $consulta);
        $respuesta=mysqli_num_rows($resultado)>0;
        mysqli_free_result($resultado);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        $respuesta=error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No se ha podido hacer la consulta: ".$e->getMessage()."</p>");
    }
    return $respuesta;
}

function repetido_editando($conexion,$tabla,$columna,$valor,$columna_clave,$valor_clave)
{
 //REALIZO LA CONSULTA
    try{
        $consulta="select * from ".$tabla." where ".$columna."='".$valor."' AND ".$columna_clave."<>'".$valor_clave."'";
        $resultado=mysqli_query($conexion, $consulta);
        $respuesta=mysqli_num_rows($resultado)>0;
        mysqli_free_result($resultado);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        $respuesta=error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No se ha podido hacer la consulta: ".$e->getMessage()."</p>");
    }
    return $respuesta;
}
// esta funcion es la que puede recibir 4 o 6 parametros; es refactorizar las dos funciones en una.............
function repetido_variable($conexion,$tabla,$columna,$valor,$columna_clave=null,$valor_clave=null)
{
 //REALIZO LA CONSULTA
    try{
        if(isset($columna_clave)){
            $consulta="select * from ".$tabla." where ".$columna."='".$valor."' AND ".$columna_clave."<>'".$valor_clave."'";
        }else{
            $consulta="select * from ".$tabla." where ".$columna."='".$valor."'";
        }
       
        $resultado=mysqli_query($conexion, $consulta);
        $respuesta=mysqli_num_rows($resultado)>0;
        mysqli_free_result($resultado);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        $respuesta=error_page("Práctica 1º CRUD","<h1>Práctica 1º CRUD</h1><p>No se ha podido hacer la consulta: ".$e->getMessage()."</p>");
    }
    return $respuesta;
}




?>