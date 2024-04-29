<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .en_linea{display:inline}
        .enlace{border:none;background:none;color:blue;text-decoration:underline;cursor:pointer}
        .mensaje{font-size:1.25em;color:blue}
        .reducida{height:100px}
        .img_editar{width:30%}
        .contenedor{
            display: flex;
            flex-wrap: wrap;
        }
        .list_libros{
            border: 1px solid black;
            margin: 0.5rem;
            flex: 0 25%;
        }
    </style>
</head>
<body>
    <h1>ESTOY EN EL GESTOR DE LIBROS</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log["lector"];?></strong> - 
        <form class="en_linea" action="index.php" method="post">
            <button class="enlace" name="btnSalir" type="submit">Salir</button>
        </form>
    </div>
</body>
</html>