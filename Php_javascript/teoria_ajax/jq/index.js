/*donde esta la api*/
const DIR_SERV =
    "http://localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/ServiciosWeb/teoriaServiciosWeb/primera_api";

/*
  estructura de llamada AJAX

  function llamada_get1() {
    
    $.ajax({


    })
    .done(function(data){})

    .fail(function(){});
}


*/
function llamada_get1() {
    $.ajax({
        // json de configuracion /*parametros que se le pasan*/

        url: DIR_SERV + "/saludo",
        dataType: "json",
        type: "GET",
    })
        /*si la llamada tiene exito*/
        .done(function (data) {
            $("#respuesta").html(data.mensaje); //data.mensaje--> mensaje es poeque lo ehmos definido asi en al api

        })
        /*si la llamada NO tiene exito*/
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });
}

function llamada_get2() {
    var nombre = "Maria Jose llamada get2"
    $.ajax({
        // json de configuracion /*parametros que se le pasan*/

        url: encodeURI(DIR_SERV + "/saludo/" + nombre),
        dataType: "json",
        type: "GET",
    })
        /*si la llamada tiene exito*/
        .done(function (data) {
            $("#respuesta").html(data.mensaje); //data.mensaje--> mensaje es poeque lo ehmos definido asi en al api

        })
        /*si la llamada NO tiene exito*/
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });
}


function llamada_post() {
    var nombre = "Juan Jose llamada post"
    $.ajax({
        // json de configuracion /*parametros que se le pasan*/

        url: DIR_SERV + "/saludo",
        dataType: "json",
        type: "POST",
        data:{"nombre":nombre}
    })
        /*si la llamada tiene exito*/
        .done(function (data) {
            $("#respuesta").html(data.mensaje); //data.mensaje--> mensaje es poeque lo ehmos definido asi en al api

        })
        /*si la llamada NO tiene exito*/
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });
}

function llamada_delete() {
    var id_borrar = 5;
    $.ajax({
        // json de configuracion /*parametros que se le pasan*/

        url: DIR_SERV + "/borrar_saludo/"+id_borrar,
        dataType: "json",
        type: "DELETE"
      
    })
        /*si la llamada tiene exito*/
        .done(function (data) {
            $("#respuesta").html(data.mensaje); //data.mensaje--> mensaje es poeque lo ehmos definido asi en al api

        })
        /*si la llamada NO tiene exito*/
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });
}


function llamada_put() {
    var id_actualizr = 5;
    var nuevo_nombre="Nuevo nombre"
    $.ajax({
        // json de configuracion /*parametros que se le pasan*/

        url: DIR_SERV + "/actualiar_saludo/"+id_actualizr,
        dataType: "json",
        type: "PUT",
        data:{"nombre":nuevo_nombre}
    })
        /*si la llamada tiene exito*/
        .done(function (data) {
            $("#respuesta").html(data.mensaje); //data.mensaje--> mensaje es poeque lo ehmos definido asi en al api

        })
        /*si la llamada NO tiene exito*/
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });
}

function obtener_productos() {
    $.ajax({
        // json de configuracion /*parametros que se le pasan*/

        url: "http://localhost/Proyectos/Curso23_24PHP/Curso23_24PHP/ServiciosWeb/Ejercicio1/servicios_rest/productos",
        dataType: "json",
        type: "GET",
    })
        /*si la llamada tiene exito*/
        .done(function (data) {
            if(data.mensaje_error){
                
                $("#respuesta").html(data.mensaje_error); 
            }else{
                console.log("entra")
                var tabla_productos="<table>"
                tabla_productos+="<tr><th>COD</th><th>Nombre Corto</th><th>PVP</th></tr>";
                $.each(data.productos, function(key,tupla){
                    tabla_productos+="<tr>";
                    tabla_productos+="<td>"+tupla["cod"]+"</td>";
                    tabla_productos+="<td>"+tupla["nombre_corto"]+"</td>";
                   tabla_productos+="<td>"+tupla["PVP"]+"</td>";
                    tabla_productos+="</tr>";
                });

                 tabla_productos+="</table>"

                $("#respuesta").html(tabla_productos); 

            }

          

        })
        /*si la llamada NO tiene exito*/
        .fail(function (a, b) {
            $("#respuesta").html(error_ajax_jquery(a, b));
        });
}


function error_ajax_jquery(jqXHR, textStatus) {
    var respuesta;
    if (jqXHR.status === 0) {
        respuesta = "Not connect: Verify Network.";
    } else if (jqXHR.status == 404) {
        respuesta = "Requested page not found [404]";
    } else if (jqXHR.status == 500) {
        respuesta = "Internal Server Error [500].";
    } else if (textStatus === "parsererror") {
        respuesta = "Requested JSON parse failed.";
    } else if (textStatus === "timeout") {
        respuesta = "Time out error.";
    } else if (textStatus === "abort") {
        respuesta = "Ajax request aborted.";
    } else {
        respuesta = "Uncaught Error: " + jqXHR.responseText;
    }
    return respuesta;
}
// para cuando carga la página (tira de obtener productos)
$(document).ready(function(){

obtener_productos() ;

})