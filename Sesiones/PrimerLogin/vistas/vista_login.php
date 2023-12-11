<?php
if (isset($_POST["btnLoggin"])) {

$error_usuario = $_POST["user"] == "" ;
$error_clave =  $_POST["clave"] == "" ;
$error_form = $error_usuario || $error_clave;
if (!$error_form) {
    //Continuo el Loggin
    echo "<h1>HOLA</h1>";
    try {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        session_destroy();
        die(error_page("Error", "<p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p>"));
    }
    try {
            $consulta="select usuario from usuarios where usuario='".$_POST["user"]."' and clave='".md5($_POST["clave"])."'";
            $resultado=mysqli_query($conexion,$consulta);

    } catch (Exception $e) {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Error", "<p>No se ha podido realizar la consulta " . $e->getMessage() . "</p>"));
    }
    if(mysqli_num_rows($resultado)>0){
        //el usuario esta en la base de datos
     
        $_SESSION["usuario"]=$_POST["user"];
        $_SESSION["clave"]=md5($_POST["clave"]);
        $_SESSION["ultima_accion"]=time();
        mysqli_free_result($resultado);
        mysqli_close($conexion);
        header("Location:index.php");
        exit;


    }else{
        //no esta en la base de datos
        $error_usuario=true;
        mysqli_free_result($resultado);
        mysqli_close($conexion);
    }
}
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Primer Loggin</title>
<style>
    .error{color:red};
</style>
</head>

<body>
<h1>Primer Loggin</h1>
<form action="index.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="user">Usuario:</label>
        <input type="text" name="user" id="user" value="<?php if(isset($_POST["user"])) echo $_POST["user"]?>">
        <?php
        if(isset($_POST["btnLoggin"])&& $error_usuario){
            if($_POST["user"]==""){
                echo "<span class='error'>El campo no puede estar vacio</span>";
            }
            else{
                echo "<span class='error'>Usuario o contraseña no existe en la base de datos</span>";
            }

        }
     
        ?>
    </p>
    <p>
        <label for="clave">Contraseña:</label>
        <input type="password" name="clave" id="clave">
        <?php
        if(isset($_POST["btnLoggin"])&& $error_clave){
           
                echo "<span class='error'>La clave esta vacia</span>";
            }
          
                   

     
        ?>
    </p>
    <p>
        <button type="submit" name="btnLoggin" id="btnLoggin">Ingresar</button>
    </p>
</form>
<?php
    if(isset($_SESSION["seguridad"])){

        echo "<p class='mensaje'>".$_SESSION["seguridad"]."</p>";
        session_destroy();
    }


?>
</body>

</html>