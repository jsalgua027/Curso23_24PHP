<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="recogida.php" method="post" enctype="multipart/form-data">
        <!-- get envia y muestra post envia y oculta en el url para realizar pruebas se usa el get-->

        <h1>Rellena tu CV</h1>
        <p> <label for="nombre">Nombre </label> </br>  <!--label para que si pinchas en el p te lleve al input-->
            <input type="text" name="nombre" id="nombre" /> <!--Tengo que añadir el name para que mande el valor -->
        </p>
        <p><label for="Apellidos">Apellidos </label> </br>
            <input type="text" name="apellidos" id="apellidos" />
        </p>
        <p><label for="clave">Clave </label> </br>
            <input type="password" name="clave" id="clave" />
        </p>
        <p><label for="dni">DNI </label> </br>
            <input type="text" name="dni" id="dni" />
        </p>
        <p>Sexo</br> <!-- fundamental poner el value para que se sepa el valor de la seleccion en la url-->
            <input type="radio" name="sexo" id="hombre" value="hombre" /> <label for="hombre">Hombre</label></br>
            <input type="radio" name="sexo"   id="mujer" value="mujer" /> <label for="mujer">Mujer</label> <!-- checked para que salga seleccionado por defecto -->
        </p>
        <p>
            <label for="foto">Incluir foto</label>
            <input type="file" name="foto" id="foto" accept="image/*"> <!--accept es para que solo acepte imagenes -->
        </p>
        <p>
            <label for="nacido">Nacido en:</label> 
            <select name="nacimiento" id="nacimiento">

                <option value="malaga" selected >Malaga</option>  <!-- selected para que salga seleccionado por defecto -->
                <option value="cadiz">Cadiz</option>
                <option value="sevilla">Sevilla</option>

            </select>


        </p>

        <p>
            <label for="comentarios">Comentarios</label>

            <textarea id="comentarios" name="comentarios"></textarea>
        </p>

        <p>

            <input type="checkbox" name="boletin" id="boletin" />
            <label for="boletin">Suscribirme al boletin de novedades </label>
        </p>
        <p>

            <button type="submit" name="guardar"> Guardar cambios</button>
            <button type="reset" name="borrar"> Borrar los datos</button>

        </p>


    </form>
</body>

</html>