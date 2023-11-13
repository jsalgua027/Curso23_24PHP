
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
    <style>
        .erro{color:red}
    </style>
</head>
<body>
    <h2>Agregar Nuevo Usuario</h2>
    <form action="vista_nuevo.php" method="post" enctype="multipart/form-data" >
        <p>
            <label for="nombre">Nombre</label></br>
            <input type="text" name="nombre" id="nombre" maxlength="50" value="">
        </p>
        <p>
            <label for="usuario">Usuario</label></br>
            <input type="text" name="usuario" id="usuario" maxlength="30" value="">
        </p>
        <p>
            <label for="clave">Contraseña</label></br>
            <input type="password" name="clave" id="clave" maxlength="50" value="">
        </p>
        <p>
            <label for="dni">DNI</label></br>
            <input type="text" name="dni" id="dni" maxlength="50" value="">
        </p>
        <p>
            <label for="sexo">Sexo</label></br>
            <input type="radio" name="hombre" value="mujer">
            <label for="hombre">Hombre</label></br>
            <input type="radio" name="mujer" value="mujer">
            <label for="hombre">mujer</label>

        </p>
        <p>
            <input type="file" name="archivo" >
        </p>
    </form>


</body>
</html>


<?php
echo"<h1>QUILLO AHORA SI ENTRO AQUI</h1>"

?>