<?php

require "src/funciones_servicios.php";
require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;


//login
$app->post('/login', function ($request) {


   $usuario = $request->getParam("usuario");
   $clave = $request->getParam("clave");

   echo json_encode(login($usuario, $clave));
});
//logueado aqui ya usamos los valores intoducidos al loguarse,
// osea usamos los $sessions

$app->get('/logueado', function ($request) {

   session_id($request->getParam("api_session"));
   session_start();

   if (isset($_SESSION["usuario"])) {
      $usuario = $_SESSION["usuario"];
      $clave = $_SESSION["clave"];
      echo json_encode(logueado($usuario, $clave));
   } else {

      session_destroy();
      $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
      echo json_encode($respuesta);
   }
});
//salir

$app->post("/salir", function ($request) {

   session_id($request->getParam("api_session"));
   session_start();
   session_destroy();
   $respuesta["logout"] = "Sesión cerrada";
   echo json_encode($respuesta);
});
//alumnos

$app->get("/alumnos", function ($request) {
   
   session_id($request->getParam("api_session"));
   session_start();
   if (isset($_SESSION["usuario"])) {

      echo json_encode(alumnos());
   } else {

      session_destroy();
      $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
      echo json_encode($respuesta);
   }
   
   

});
//notasAlumno
$app->get("/notasAlumno/{cod_alu}", function ($request) {
   
 
   session_id($request->getParam("api_session"));
   session_start();
   $alumno=$request->getAttribute("cod_alu");
   if (isset($_SESSION["usuario"])) {

      echo json_encode(notasAlumno($alumno));
   } else {

      session_destroy();
      $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
      echo json_encode($respuesta);
   }
   
 

   

});
//NotasNoEvalAlumno
$app->get("/NotasNoEvalAlumno/{cod_alu}", function ($request) {
   
 
   session_id($request->getParam("api_session"));
   session_start();
   $alumno=$request->getAttribute("cod_alu");
   if (isset($_SESSION["usuario"])) {

      echo json_encode(NotasNoEvalAlumno($alumno));
   } else {

      session_destroy();
      $respuesta["no_auth"] = "No tienes permiso para usar este servicio";
      echo json_encode($respuesta);
   }
});
//quitarNota
//ponerNota
//cambiarNota







// Una vez creado servicios los pongo a disposición
$app->run();
