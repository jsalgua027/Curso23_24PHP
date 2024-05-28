<?php


define("DIR_SERV",//"http://localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/Recuperacion/Examen_Rec_DWESE_23_24/Examen_REC_DWESE/servicios_rest" //clase
"http://localhost/Proyectos/Curso23_24PHP/Recuperacion/Examen_Rec_DWESE_23_24/Examen_REC_DWESE/servicios_rest" // casa
);
define("MINUTOS",5);

function consumir_servicios_REST($url,$metodo,$datos=null)
{
    $llamada=curl_init();
    curl_setopt($llamada,CURLOPT_URL,$url);
    curl_setopt($llamada,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($llamada,CURLOPT_CUSTOMREQUEST,$metodo);
    if(isset($datos))
        curl_setopt($llamada,CURLOPT_POSTFIELDS,http_build_query($datos));
    $respuesta=curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}

function error_page($title,$body)
{
    $html='<!DOCTYPE html><html lang="es"><head><meta charset="UTF-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1.0">';
    $html.='<title>'.$title.'</title></head>';
    $html.='<body>'.$body.'</body></html>';
    return $html;
}
?>