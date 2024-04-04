<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logeado</title>
    <style>
            .enlinea{display:inline}
            .enlace{border:none;background:none;text-decoration:underline;color:blue;cursor:pointer}
    </style>
</head>
<body>
    <h1>USUARIO NORMAL</h1>
    <h2>Práctica Rec1</h2>
    <div>Bienvenido <strong><?php echo $datos_usuario_logeado["nombre"];?></strong> - 
            <form class='enlinea' action="index.php" method="post">
                <button class='enlace' type="submit" name="btnSalir">Salir</button>
            </form>
        </div>
</body>
</html>