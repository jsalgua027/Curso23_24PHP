<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi primera pagina</title>
</head>

<body>
<form action="recogida.php" method="post" enctype="multipart/form-data">
    <h1>Esta es mi super página</h1>
    <p>

        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" />

    </p>

    <p>

        <label for="nacido">Nacido en: </label>
        <select name="nacimiento" id="nacimiento">

            <option value="malaga" selected>Malaga</option> <!-- selected para que salga seleccionado por defecto -->
            <option value="cadiz">Cadiz</option>
            <option value="sevilla">Sevilla</option>

        </select>

    </p>


    <p>
        <label for="sexo">Sexo</label> <!-- fundamental poner el value para que se sepa el valor de la seleccion en la url-->
        <input type="radio" name="sexo" id="hombre" value="hombre" /> <label for="hombre">Hombre</label>
        <input type="radio" name="sexo" id="mujer" value="mujer" /> <label for="mujer">Mujer</label> <!-- checked para que salga seleccionado por defecto -->
    </p>

    <p>

        <label for="aficiones">Aficiones</label>
        <input type="checkbox" name="deportes" id="deportes" />
        <label for="deportes">Deportes</label>
        <input type="checkbox" name="lectura" id="lectura" />
        <label for="lectura">Lectura</label>
        <input type="checkbox" name="otros" id="otros" />
        <label for="otros">Otros</label>


    </p>

    <p>
        <label for="comentarios">Comentarios</label>

        <textarea id="comentarios" name="comentarios"></textarea>
    </p>


    <p>

        <button type="submit" name="enviar"> Enviar</button>


    </p>





</body>

</html>