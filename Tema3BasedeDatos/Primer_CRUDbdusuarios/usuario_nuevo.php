<?php
if (isset($_POST["btnNuevoUsuario"])|| isset($_POST["btnConInsentar"])) {

    //si pulso insertar controlo errorer del formulario de esta pagina

    if(isset($_POST["btnConInsentar"])){
        $error_nombre=$_POST["nombre"]=="";
        $error_usuario=$_POST["usuario"]=="";
        $error_clave=$_POST["clave"]=="";
        //si esta vacio o no pasa el filtro
        $error_email=$_POST["email"]==""||!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);

        $error_form=$error_nombre||$error_usuario||$error_clave||$error_email;

        if(!$error_form)
        {
            //los header location hay que hacerlos antes de escibir el hmtl


        }




    }



?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Practica 1 CURD</title>
    </head>

    <body>
        <h1>Nuevo Usuario</h1>

        <form action="usuario_nuevo.php" method="post">
            <p>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" maxlength="30" value="">
            </p>
            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario" maxlength="20" value="">
            </p>

            <p>
                <label for="clave">Contraseña:</label>
                <input type="password" name="clave" maxlength="15">
            </p>

            <p>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" maxlength="50"value="">
            </p>


            <p>

                <button type="submit" name="btnConInsentar">Continuar</button>
                <button type="submit" name="btnVolver">Volver</button>
            </p>


        </form>

    </body>

    </html>


<?php
} else {

    header("Location:index.php");
    exit;
}

?>