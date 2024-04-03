<?php
session_name("practica2_recu");
session_start();

require "src/ctes_func.php";
/*
//aqui hago la consulta a la base de datos para mostralos si al usuario es admin
if (isset($_POST["btnEntrar"]) && $datos_usuario_logeado["tipo"] == "admin") {
    try {
        $consulta = "select * from usuarios";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
    } catch (PDOException $e) { // si falla la conexion
        $sentencia = null;
        $conexion = null;
        die("<p>No hacer la consulta por fallo de la conexión: " . $e->getMessage() . "</p></body></html>");
    }
    if ($sentencia->rowCount() > 0) {
        $todos_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    } else {
        echo "<p>no hay Usuarios en la tabla solitada</p>";
    }
}



*/



if (isset($_SESSION["usuario"])) {
   require "src/seguridad.php";
   if($datos_usuario_logeado["tipo"]=="normal")
   {
    require "vistas/vista_normal.php";
   }
   else{
    require "vistas/vista_admin.php";
   }
}elseif (isset($_POST["btnRegistro"]))
 {
    require "vistas/vista_registro.php";
}
 else 
 {
    require "vistas/vista_login.php";
}


