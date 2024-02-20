<?php
// Permitir cualquier origen (debes restringir esto según tus necesidades de seguridad)
header("Access-Control-Allow-Origin: *");

// Permitir ciertos métodos HTTP
header("Access-Control-Allow-Methods: POST");

// Permitir ciertos encabezados en las solicitudes
header("Access-Control-Allow-Headers: Content-Type");

$myJSON = '[
    {"nombre":"Gala Placidia","marido":"Ataúlfo"},
    {"nombre":"Flavia Valiana","marido":"Teodorico"},
    {"nombre":"Ragnahilda (Ragnachildis)","marido":"Eurico"},
    {"nombre":"Teodegonda","marido":"Alarico II"},
    {"nombre":"Clotilde (Chrodechildis)","marido":"Amalarico"},
    {"nombre":"Gosuinda (Goiswintha)","marido":"Atanagildo"},
    {"nombre":"Teodosia de Cartagena","marido":"Leovigildo"},
    {"nombre":"Goisuinta (Goiswintha)","marido":"Leovigildo"},
    {"nombre":"Ingundis","marido":"Hermenegildo"},
    {"nombre":"Baddo (Bauda)","marido":"Recaredo I"},
    {"nombre":"Clodosvinta","marido":"Recaredo I"},
    {"nombre":"Hildoara","marido":"Gundemaro"},
    {"nombre":"Teodora","marido":"Suintila"},
    {"nombre":"Riciberga","marido":"Chindasvinto"},
    {"nombre":"Liuvigoto","marido":"Ervigio"},
    {"nombre":"Cixila","marido":"Egica"},
    {"nombre":"Egilona","marido":"Don Rodrigo"}
    ]';
    echo $myJSON;
    
?>

