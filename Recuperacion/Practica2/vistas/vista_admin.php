<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
              
        td,th{border:1px solid black}
        table{border-collapse:collapse}
        th{background-color:#CCC}
        table img{width:50px;}
        .enlace{border:none;background:none;cursor:pointer;color:blue;text-decoration:underline}
        .error{color:red}
        .mensaje{color:blue;font-size:1.5em} 
        .txt_centrado{text-align:center}
        .no_bordes{border:none}
        .centrado{width:80%;margin:0 auto}
        .grande{font-size:1.5em}
    </style>
</head>
<body>
    <h1>USUARIO ADMIN</h1>
    <h2>Práctica Rec2</h2>
    <div>Bienvenido <strong><?php echo $datos_usuario_logeado["nombre"];?></strong> - 
            <form class='enlinea' action="index.php" method="post">
                <button class='enlace' type="submit" name="btnSalir">Salir</button>
            </form>
        </div>

     <h2>Lista de Usuarios</h2>
     <?php
      echo "<table id='tb_principal' class='txt_centrado centrado'>";
     echo "<tr><th>#</th><th>Foto</th><th>Nombre</th><th><button class='enlace' type='submit' name='btnNuevoUser'>Usuario+</button></th></tr>";
        foreach ($todos_usuarios as $tupla) {
            echo "<tr>";
            echo"<td>" . $tupla["id_usuario"] . "</td>";
            echo"<td><img src='images/".$tupla["foto"]."'name='foto'title='fotoUser'></td>";
            echo"<td>" . $tupla["nombre"] . "</td>";
            echo"<td><button class='enlace' type='submit' name='btnBorrar'>Borrar</button>-<button class='enlace' type='submit' name='btnEditar'>Editar</button></td>";
            echo "</tr>";
        }
        echo "</table>";
     ?>   
</body>
</html>