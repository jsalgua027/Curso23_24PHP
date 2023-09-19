<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="post" enctype="multipart/form-data">


        <h1>Rellena tu CV</h1>
        <p> <label for="nombre">Nombre </label> </br>
            <input type="text" name="nombre" id="nombre" />
        </p>
        <p><label for="Apellidos">Apellidos </label> </br>
            <input type="text" name="apelidos" id="apellidos" />
        </p>
        <p><label for="clave">Clave </label> </br>
            <input type="password" name="clave" id="clave" />
        </p>
        <p><label for="dni">DNI </label> </br>
            <input type="text" name="dni" id="dni" />
        </p>
        <p>Sexo</br>
            <input type="radio" name="sexo" id="hombre" /> <label>Hombre</label></br>
            <input type="radio" name="sexo" id="mujer" /> <label>Mujer</label>
        </p>
        <p> Incluir mi foto:
            <input type="file" name="foto" id="foto">
        </p>
        <p>
            Nacido en:
            <select name="nacimiento" id="nacimiento">

                <option value="malaga">Malaga</option>
                <option value="cadiz">Cadiz</option>
                <option value="sevilla">Sevilla</option>

            </select>


        </p>

        <p>Comentarios

            <textarea></textarea>
        </p>

        <p>

            <input type="checkbox" name="boletin" id="boletin" />
            <label for="boletin">Suscribirme al boletin de novedades </label>
        </p>
        <p>

            <button type="submit"> Guardar cambios</button>
            <button type="reset"> Borrar los datos</button>

        </p>


    </form>
</body>

</html>