<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App login vista normla</title>
    <style>

        .enlace{ background-color: none; border: none; text-decoration: underline; color: blue;cursor: pointer;}
        .enlinea{display: inline;}
    </style>
</head>
<body>
        <h1>App login Admin</h1>
        <div>
            Bienvenido <strong><?php echo $datos_usuario_log->usuario?></strong> <form class="enlinea" action="index.php" method="post">
                <button class="enlace" type="submit" name="btnSalir">Salir</button>
            </form>
        </div>
</body>
</html>