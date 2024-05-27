<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica Rec 3</title>
    <style>
        .en_linea{display:inline}
        .enlace{border:none;background:none;color:blue;text-decoration:underline;cursor:pointer}
        .mensaje{font-size:1.25em;color:blue}
    </style>
</head>
<body>
    <h1>Práctica ExamenRec_SW_23_24  HORARIOS</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log["usuario"];?></strong> - 
        <form class="en_linea" action="index.php" method="post">
            <button class="enlace" name="btnSalir" type="submit">Salir</button>
        </form>
        <?php
           $respuesta = consumir_servicios_REST(DIR_SERV. "/usuario/2", "GET");
           $json = json_decode($respuesta, true);
           if (!$json) {
               session_destroy();
               die(error_page("Práctica ExamenRec_SW_23_24  HORARIOS", "<h1>Práctica ExamenRec_SW_23_24  HORARIOS</h1><p>Sin respuesta oportuna de la API usuario</p>"));  
           }
           
           if (isset($json["error"])) {
               session_destroy();
               consumir_servicios_REST(DIR_SERV . "/salir", "POST");
               die(error_page("Práctica ExamenRec_SW_23_24  HORARIOS", "<h1>Práctica ExamenRec_SW_23_24  HORARIOS</h1><p>" . $json["error_bd"] . "</p>"));
           }
           
           if (isset($json["no_auth"])) {
               session_unset();
               $_SESSION["seguridad"] = "Usted ha dejado de tener acceso a la API. Por favor vuelva a loguearse.";
               header("Location:index.php");
               exit();
           }
           
           $detalles_usu = $json["usuario"];
           
           if ($detalles_usu) {
               echo "<p><strong>Id: </strong>" . $detalles_usu["id_usuario"] . "</p>";
               echo "<p><strong>Nombre: </strong>" . $detalles_usu["nombre"] . "</p>";
               echo "<p><strong>Usuario: </strong>" . $detalles_usu["usuario"] . "</p>";
               echo "<p><strong>Contraseña: </strong>*********</p>"; 
           }
        
        
        ?>
    </div>
    <?php
    if(isset($_SESSION["mensaje_registro"]))
    {
        echo "<p class='mensaje'>".$_SESSION["mensaje_registro"]."</p>";
        unset($_SESSION["mensaje_registro"]);
    }
    ?>
</body>
</html>