<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- añado estilo rojo a los errores de campos vacios -->
    <style>
    .error{

        color:red
    }

</style>
</head>
<body>
    <form action="index.php" method="post" enctype="multipar/form-data">
    <h1>Esta es mi super pagina</h1>

        <p>

            <label for="name">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?php  if (isset($_POST['nombre'])) {
                 echo $_POST['nombre'];
               
                  }?>">

                <?php 
                    // controlo que si le doy a el boton de enviar pero me llega error de que es campo vacio desde el index
                    // aviso de campo obligatorio
                    if(isset($_POST['enviar'])&& $error_nombre){
                        echo "<span class='error'>*Campo Obligatorio* </span>";

                    }
                
                ?>  
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
            <input type="radio" name="sexo" id="mujer" value="mujer">

            <?php 
                    // controlo que si le doy a el boton de enviar pero me llega error de que es campo vacio desde el index
                    // aviso de campo obligatorio
                    if(isset($_POST['enviar'])&& $error_sexo){
                        echo "<span class='error'>*Campo Obligatorio* </span>";

                    }
                
                ?>  

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
            <label for="coment">Comentarios:</label>
            <textarea name="coment" id="coment"  <?php if (isset($_POST['coment'])) echo $_POST['coment']; ?>></textarea>

        </p>

        <p>

            <button type="submit" name="enviar">Enviar</button>
        </p>

</body>
</html>
