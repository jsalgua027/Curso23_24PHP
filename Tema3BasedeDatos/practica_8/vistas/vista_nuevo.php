

    <h2>Agregar Nuevo Usuario</h2>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre</label></br>
            <input type="text" name="nombre" id="nombre" maxlength="50" value="<?php if (isset($_POST["nombre"])) echo $_POST["nombre"]; ?>">
            <?php
            if (isset($_POST["btnGuardar"]) && $error_nombre) {
                if ($_POST["nombre"] == "")
                    echo "<span class='error'> Campo vacío</span>";
                else
                    echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
            }
            ?>
        </p>
        <p>
            <label for="usuario">Usuario</label></br>
            <input type="text" name="usuario" id="usuario" maxlength="30" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>">
            <?php
             
           
            if (isset($_POST["btnGuardar"]) && $error_usuario) {
                echo $error_usuario;
                if ($_POST["usuario"] == "")
                    echo "<span class='error'> Campo vacío</span>";
                elseif (strlen($_POST["usuario"]) > 20)
                    echo "<span class='error'> Has tecleado más de 20 caracteres</span>";
                else
                    echo "<span class='error'> Usuario repetido</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña</label></br>
            <input type="password" name="clave" id="clave" maxlength="50"><!--NO pongo value poque no se guarda la contraseña si hay error, la tiene que escribir otra vez-->
            <?php
            if (isset($_POST["btnGuardar"]) && $error_clave) {
                if ($_POST["clave"] == "")
                    echo "<span class='error'> Campo vacío</span>";
                else
                    echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
            }
            ?>
        </p>
        <p>
            <label for="dni">DNI</label></br>
            <input type="text" name="dni" id="dni" maxlength="50" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
            <?php

            if (isset($_POST["btnGuardar"]) && $error_dni) {
                if ($_POST["dni"] == "")
                    echo "<span class='error'>Campo vacio </span>";
                elseif (!dni_bien_escrito((strtoupper($_POST["dni"])))) {
                    echo "<span class='error'>El dni no esta bien escrito </span>";
                } else {

                    echo "<span class='error'>El dni no es valido </span>";
                }
            }


            ?>
        </p>
        <p>
            <label for="sexo">Sexo</label></br>
            <?php
            if (isset($_POST["btnGuardar"]) && $error_sexo) {
                echo "<span class='error'>Debe de seleccionar un sexo </span> </br>";
            }
            ?>
            <input type="radio" <?php if (isset($_POST['sexo']) && $_POST['sexo'] == 'hombre') echo 'checked'; ?> name="hombre" value="hombre">
            <label for="hombre">Hombre</label></br>
            <input type="radio" <?php if (isset($_POST['sexo']) && $_POST['sexo'] == 'mujer') echo 'checked'; ?> name="mujer" value="mujer">
            <label for="hombre">mujer</label>

        </p>
        <p>
            <label for="archivo">Seleccione un archivo imagen(Max 500KB)</label>
            <input type="file" name="archivo" id="archivo" accept="image/*">
            <?php
            // le damos al boton y hay un error....¿pero cual?
            if (isset($_POST["btnGuardar"]) && $error_archivo) {
                // si hay un error al subir al servidor (vemos los errores)
                if ($_FILES["archivo"]["name"] != "") {
                    // si no se almacena correctamente al servidor
                    if ($_FILES["archivo"]["error"]) {
                        echo "<span class='error'> No se ha podido subir el archivo al servidor</span>";
                    } elseif (!getimagesize($_FILES["archivo"]["tmp_name"])) {

                        echo "<span class='error'>El archivo seleccionado no es una fotografia</span>";
                    } else {
                        // si te pasas de tamanio
                        echo "<span class='error'> El archivo seleccionado supera los 500 MAX</span>";
                    }
                }
            }
            ?>
        </p>

        <p>
            <button type="submit" name="btnGuardar">Guardar Cambios</button>
            <button type="submit" name="atras">Atrás</button>

        </p>
    </form>



