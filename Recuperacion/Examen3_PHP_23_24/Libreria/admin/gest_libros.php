<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{color:red}
        .en_linea{display:inline}
        .enlace{border:none;background:none;color:blue;text-decoration:underline;cursor:pointer}
        table{border-collapse:collapse;}
        table,th,td{border:1px solid black}
        th{background-color:#CCC}
        .reducida{height:100px}
        .img_editar{width:30%}
        .centrar{ width:80%;margin:0 auto;  } 
        .mensaje{font-size: 1.25rem;color:blue}
        #t_editar, #t_editar td{border:none}
        .centrado{text-align: center;}
        .d_flex{display:flex;justify-content: space-between;margin-bottom:0.5em}
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
        <form class="en_linea" action="../index.php" method="post">
            <button class="enlace" name="btnSalir" type="submit">Salir</button>
        </form>
    </div>
</body>
</html>