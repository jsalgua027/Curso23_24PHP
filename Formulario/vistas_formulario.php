<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="vistas_respuestas.php" method="post" enctype="multipar/form-data">
    <h1>Esta es mi super pagina</h1>

        <p>

            <label for="name">Nombre: </label>
            <input type="text" name="nombre" id="nombre">
        </p>


        <p>
          <label for="nacido">Nacido en:</label>
            <select name="nacido" id="nacido">Nacido en:
                <option value="malaga">Malaga</option>
                <option value="sevilla">sevilla</option>
                <option value="cadiz">cadiz</option>


            </select>
         </p>

        <p>
            <label for="sexo">Sexo:</label>
            <label for="hombre">Hombre</label>
            <input type="radio" name="sexo"id="hombre" value="hombre">
            <label for="mujer">mujer</label>
            <input type="radio" name="mujer" id="mujer" value="mujer">

        </p>

        <p>
            <label for="aficiones">Aficiones:</label>
            <label for="deportes">Deportes</label>
            <input type="checkbox" name="deportes" id="deportes">
            <label for="lectura">Lectura</label>
            <input type="checkbox" name="lectura" id="lecutra">
            <label for="otros">Otros</label>
            <input type="checkbox" name="otros" id="otros">
        
        </p>


        <p>
            <label for="comentarios">Comentarios:</label>
            <textarea name="comentarios" id="comentarios" ></textarea>

        </p>

        <p>

            <button type="submit" name="enviar">Enviar</button>
        </p>

</body>
</html>
