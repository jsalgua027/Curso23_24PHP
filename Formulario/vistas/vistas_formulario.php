



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- añado estilo rojo a los errores de campos vacios -->
    <style>
        .error {

            color: red
        }
    </style>
</head>

<body>
    <form action="index.php" method="post" enctype="multipar/form-data">
        <h1>Esta es mi super pagina</h1>

        <p>

            <label for="i1">Nombre: </label> <!--el for se une con el input por el id // con el value mantengo el valor que ya ha escrito en el formulario OJO NO 
         PONER ESPACIOS DENTRO DEL VALUE Y LA ETIQUETA DE PHP PORQUE ESTARIAMOS METIENDO CARACTERES VACIOS !!!!!!!-->
            <input type="text" name="nombre" id="i1" value="<?php if (isset($_POST['nombre'])) {
                                                                echo $_POST['nombre'];
                                                            } ?>">

            <?php
            // controlo que si le doy a el boton de enviar pero me llega error de que es campo vacio desde el index
            // aviso de campo obligatorio
            if (isset($_POST['enviar']) && $error_nombre) {
                echo "<span class='error'>*Campo Obligatorio* </span>";
            }

            ?>
        </p>


        <p>
            <label for="i2">Nacido en:</label>
            <select name="nacido" id="i2">Nacido en:
                <option value="malaga" <?php if (isset($_POST['nacido']) && ($_POST['nacido'] == "malaga")) echo "selected"; ?>>Malaga</option>
                <option value="sevilla" <?php if (isset($_POST['nacido']) && ($_POST['nacido'] == "sevilla")) echo "selected"; ?>>sevilla</option>
                <option value="cadiz" <?php if (isset($_POST['nacido']) && ($_POST['nacido'] == "cadiz")) echo "selected"; ?>>cadiz</option>


            </select>
        </p>

        <p>
            <label for="sexo">Sexo:</label>
            <label for="hombre">Hombre</label>
            <input type="radio" name="sexo" id="hombre" value="hombre" <?php if (isset($_POST['sexo']) && ($_POST['sexo'] == "hombre")) echo "checked"; ?>>
            <label for="mujer">Mujer</label>
            <input type="radio" name="sexo" id="mujer" value="mujer" <?php if (isset($_POST['sexo']) && ($_POST['sexo'] == "mujer")) echo "checked"; ?>>

            <?php
            // controlo que si le doy a el boton de enviar pero me llega error de que es campo vacio desde el index
            // aviso de campo obligatorio
            if (isset($_POST['enviar']) && $error_sexo) {
                echo "<span class='error'>*Campo Obligatorio* </span>";
            }

            ?>

        </p>

        <!--
            mi version ojo no he puesto el value y es un error
            <p>
            <label for="aficiones">Aficiones:</label>
            <label for="deportes">Deportes</label>
            <input type="checkbox" name="deportes" id="deportes">
            <label for="lectura">Lectura</label>
            <input type="checkbox" name="lectura" id="lecutra">
            <label for="otros">Otros</label>
            <input type="checkbox" name="otros" id="otros">
        
        </p>
        -->


        <p>
            Aficiones:
            <label for="deportes">Deportes</label>
            <input type="checkbox" name="aficiones[]" id="deportes" value="deportes" <?php if (isset($_POST["aficiones"]) && en_array("deportes", $_POST["aficiones"])) echo "checked"; ?>>
            <label for="lectura">Lectura</label>
            <input type="checkbox" name="aficiones[]" id="lectura" value="lectura" <?php if (isset($_POST["aficiones"]) && en_array("lectura", $_POST["aficiones"])) echo "checked"; ?>>
            <label for="otros">Otros</label>
            <input type="checkbox" name="aficiones[]" id="otros" value="otros" <?php if (isset($_POST["aficiones"]) && en_array("otros", $_POST["aficiones"])) echo "checked"; ?>>

        </p>





        <p>
            <label for="coment">Comentarios:</label>
            <textarea name="coment" id="coment" <?php if (isset($_POST['coment'])) echo $_POST['coment']; ?>></textarea>

        </p>

        <p>

            <button type="submit" name="enviar">Enviar</button>
        </p>

</body>

</html>