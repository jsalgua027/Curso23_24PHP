<?php
require "src/config_bd.php";

function login($datos)
{

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario=? AND clave=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);

        if ($sentencia->rowCount() > 0) // iniciamos sesion para genera la seguridad  del usos de sevicios solo dependiendo del tipo de usuario
        {
            session_name("API_Pract2_Rec_23_24");
            session_start();

            $respuesta = $sentencia->fetch(PDO::FETCH_ASSOC); //datos usuario
            $respuesta["api_key"] = session_id(); // genero el número unico 

            $_SESSION["usuario"] = $respuesta["usuario"]["usuario"];
            $_SESSION["clave"] = $respuesta["usuario"]["clave"];
            $_SESSION["tipo"] = $respuesta["usuario"]["tipo"];
        } else {
            $respuesta["mensaje"] = "El usuario no se encuentra registrado en la BD";
        }

        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}

function logueado($datos)
{

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where usuario=? AND clave=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute($datos);

        if ($sentencia->rowCount() > 0)
         {
            $respuesta = $sentencia->fetch(PDO::FETCH_ASSOC); //datos usuario

        } 
        else 
        {
            $respuesta["mensaje"] = "El usuario no se encuentra registrado en la BD";
        }

        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}




function insertar_usuario($nombre, $usuario, $clave, $dni, $sexo, $subscripcion)
{

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "select insert into usuarios(nombre,usuario,clave,dni,sexo,subscripcion) values(?,?,?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$nombre, $usuario, $clave, $dni, $sexo, $subscripcion]);
        $respuesta["ultm_id"] = $conexion->lastInsertId(); // la ulitma id para la gestión de la foto
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}

function actulizar_foto($id_usuario, $nombre_foto_nuevo)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "update usuarios set foto=? where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id_usuario, $nombre_foto_nuevo]);
        $respuesta["mensaje"] = "Actuazlizació realizada con exito";
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}

function repetido_insertando($tabla, $columna, $valor)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "select " . $columna . " from " . $tabla . " where " . $columna . "=?"; // podemos hacer where * pero no es necesario traerese todo
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor]);
        $respuesta["repetido"] = $sentencia->rowCount() > 0; // devuleve true o flase
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}

function repetido_editando($tabla, $columna, $valor, $columna_clave, $valor_clave)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "select " . $columna . " from " . $tabla . " where " . $columna . "=? AND " . $columna_clave . " " . $valor_clave . ""; // podemos hacer where * pero no es necesario traerese todo
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor]);
        $respuesta["repetido"] = $sentencia->rowCount() > 0; // devuleve true o flase
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}


function obtener_todos_usuarios()
{

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where tipo<>'admin'";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $respuesta["usuarios"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}

function obtener_usuarios_pag($pagina, $registros)
{

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where tipo<>'admin' LIMIT " . $pagina . ", " . $registros . "";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $respuesta["usuarios"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}

function obtener_todos_usuarios_pag($buscar)
{

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where tipo<>'admin' AND nombre LIKE '%" . $buscar . "%'";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $respuesta["usuarios"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}


function obtener_usuarios_flitro_pag($pagina, $registros, $buscar)
{


    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where tipo<>'admin' and nombre LIKE '%" . $buscar . "%' LIMIT " . $pagina . ", " . $registros . "";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute();
        $respuesta["usuarios"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}

function obtener_detalles_usuario($id_usuario)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "select * from usuarios where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id_usuario]);
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}

function borrar_usuario($id_usuario)
{
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "delete from usuarios  where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id_usuario]);
        $respuesta["mensaje"] = "Usuario borrado con exito";
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error_bd"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}


function actulizar_usuario_clave($nombre, $usuario, $clave, $dni, $sexo, $subscripcion, $id_usuario)
{

    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible conectar:" . $e->getMessage(); // los servicios no mueren eso se hace en la app aqui devolvemos esta respuesta si falla
        return $respuesta;
    }

    try {
        $consulta = "update into usuarios set nombre=?, usuario=?, dni=? ,sexo=? , subscripcion=? where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$nombre, $usuario, $clave, $dni, $sexo, $subscripcion, $id_usuario]);
        $respuesta["mensaje"] = "Usuario editado";
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $respuesta["error"] = "Imposible realizar la consulta:" . $e->getMessage();
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    }
}
