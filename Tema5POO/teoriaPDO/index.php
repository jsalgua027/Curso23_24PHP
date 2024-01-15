<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toeria PDO</title>
</head>

<body>
    <h1>Teoría PDO</h1>
    <?php
    define("MINUTOS_INACT", 5);

    define("SERVIDOR_BD", "localhost");
    define("USUARIO_BD", "jose");
    define("CLAVE_BD", "josefa");
    define("NOMBRE_BD", "bd_foro");
    /* 
     try {
        $conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {

        die("<p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
    } */




    /*  /****************************CONEXION PDO***********************************************************/

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {

        die("<p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
    };



    /*  echo"<p>todo bien<p/>" ;
    $usuario="nacho";
    $clave=md5("12345"); */
    /*    
        CONSULTA NORMAL
    try{
        $consula="select * from usuarios where usuario='".$usuario."' and clave='".$clave."'";
         $resultado=mysqli_query($conexion,$consula);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("<p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p></body></html>");
    }
    if(mysqli_num_rows($resultado)<=0)
    {
        echo "<p>No hay usuario con esas credenciales en la base de datos</p>";
    }
    else{

        $tupla=mysqli_fetch_assoc($resultado);
        echo "<p>El nombre del usuario logueado es:<strong>".$tupla["nombre"]." </strong></p>";

    } 
    mysqli_free_result($resultado);
    mysqli_close($conexion);
    */

    /************************CONSULTA PDO DE UN USUARIO*********************/
    /* 
    try{
        $consulta="select * from usuarios where usuario=? and clave=?";
        $sentencia=$conexion->prepare($consulta);
        $sentencia->execute([$usuario,$clave]);// execute solo admite arrays

         
    } catch (PDOException $e) {
        //cierro la conexion y la sentencia; como son objetos hay que cerrarlo 
       $sentencia=null;
       $conexion=null;
        die("<p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p></body></html>");
    }
    if($sentencia->rowCount()<=0)
    {
        echo "<p>No hay usuario con esas credenciales en la base de datos</p>";
    }
    else
    {
        $tupla=$sentencia->fetch(PDO::FETCH_ASSOC);//otras constantes PDO::FETCH_NUM, PDO::FETCH_OBJECT
        
        echo "<p>El nombre del usuario logueado es:<strong>".$tupla["nombre"]." </strong></p>";

    }
    //libero sentencia, cierro conexión
    $sentencia=null;
    $conexion=null; */

    /************************CONSULTA DE MAS DE UN USUARIO NORMAL****************************/
    /* 
    try{
        $consula="select * from usuarios ";
         $resultado=mysqli_query($conexion,$consula);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("<p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p></body></html>");
    }
    if(mysqli_num_rows($resultado)<=0)
    {
        echo "<p>No hay usuario con esas credenciales en la base de datos</p>";
    }
    else{

       while ($tupla=mysqli_fetch_assoc($resultado)){
        echo "<p>El nombre del usuario logueado es:<strong>".$tupla["nombre"]." </strong></p>";
       }
        

    } 
    mysqli_free_result($resultado);
    mysqli_close($conexion);

 */
    /***********************CONSULTA PDO DE VARIOS RESULTADOS**********************/
    /* try {
        $consulta = "select * from usuarios ";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute(); // execute solo admite arrays


    } catch (PDOException $e) {
        //cierro la conexion y la sentencia; como son objetos hay que cerrarlo 
        $sentencia = null;
        $conexion = null;
        die("<p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
    }
    if ($sentencia->rowCount() <= 0) {
        echo "<p>No hay usuario con esas credenciales en la base de datos</p>";
    } else {
        $respuesta = $sentencia->fetchall(PDO::FETCH_ASSOC); //otras constantes PDO::FETCH_NUM, PDO::FETCH_OBJECT
        foreach ($respuesta as $tupla) {
            echo "<p>El nombre del usuario logueado es:<strong>" . $tupla["nombre"] . " </strong></p>";
        }
    }
    //libero sentencia, cierro conexión
    $sentencia = null;
    $conexion = null;
 */
    /*************************INSERCION DE DATOS NORMAL********************************************/

    // usuario nuevo a insertar
    /*  $nombre="Juan palomo";
    $usuario="juan";
    $clave=md5("1234");
    $email="juanpalomo@gmail.com";

    try{
        $consula="insert into  usuarios(nombre,usuario,clave,email) values('".$nombre."','".$usuario."','".$clave."','".$email."')";
         $resultado=mysqli_query($conexion,$consula);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die("<p>No he podido conectarse a la base de batos: ".$e->getMessage()."</p></body></html>");
    }
    echo"<p>El Usuario  insertado con exito con la id_usuario: <strong>".mysqli_insert_id($conexion)."</strong></p>";
    mysqli_close($conexion);
 */
    /*************************INSERCION DE DATOS PDO********************************************/
    $nombre = "lucas PDO";
    $usuario = "lucas";
    $clave = md5("1234");
    $email = "lucasPDO@gmail.com";

    try {
        $consulta = "insert into usuarios(nombre,usuario,clave,email) values(?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$nombre, $usuario, $clave, $email]); // execute solo admite arrays


    } catch (PDOException $e) {
        //cierro la conexion y la sentencia; como son objetos hay que cerrarlo 
        $sentencia = null;
        $conexion = null;
        die("<p>No he podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
    }
    echo "<p>El Usuario  insertado con exito con la id_usuario: <strong>" . $conexion->lastInsertId() . "</strong></p>";
    $sentencia = null;
    $conexion = null;

    //libero sentencia, cierro conexión
    $sentencia = null;
    $conexion = null;
    ?>



</body>

</html>