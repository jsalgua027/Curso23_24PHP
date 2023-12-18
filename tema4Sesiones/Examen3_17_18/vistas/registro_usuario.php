<?php
session_name("Examen3_17_18");
session_start();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Usuario</title>
</head>

<body>
    <h1>Video Club</h1>

    <form action="index.php" method="post">
        <p>
            <label for="usuario">Nombre de usuario:</label>
            <input type="text" name="usuario" value="" />
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" name="clave" id="clave" value="">
        </p>
        <p>
            <label for="claveRepe">Repita la contraseña:</label>
            <input type="password" name="clave_r" id="clave_r" value="">
        <p>
            <label for="DNI">DNI:</label>
            <input type="text" name="dni" value="" />
        </p>
        <p>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="">
        </p>
        <p>
            <label for="telefono">Teléfono:</label>
            <input type="text" name="telefono" id="telefono" value="">
        </p>

        <p>
            <button type="submit" name="btnVolver">Volver</button>
            <button type="submit" name="btnConRegistro">Continuar</button>
        </p>



    </form>

</body>

</html>
<?php

?>