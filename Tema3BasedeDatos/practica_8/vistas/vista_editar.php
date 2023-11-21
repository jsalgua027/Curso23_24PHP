<?php
if (isset($_POST["btnEditar"])) {
            $id_usuario = $_POST["btnEditar"];
        } else {
            $id_usuario = $_POST["id_usuario"];
        }
        //abro conexión si no
        if (!isset($conexion)) {

            try {
                $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
                mysqli_set_charset($conexion, "utf8");
            } catch (Exception $e) {
                die("<p>No se ha podido conectarse a la base de datos: " . $e->getMessage() . "</p></body></html>");
            }
        }
        try {
            $consulta = "select * from usuarios where id_usuario='" . $id_usuario . "'";
            $resultado = mysqli_query($conexion, $consulta);
        } catch (Exception $e) {
            mysqli_close($conexion);
            die("<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>");
        }
        if (mysqli_num_rows($resultado) > 0) {
            //recojo datos
            if (isset($_POST["btnEditar"])) {
                $datos_usuario = mysqli_fetch_assoc($resultado);
                mysqli_free_result($resultado);
                $nombre = $datos_usuario["nombre"];
                $usuario = $datos_usuario["usuario"];
                $dni = $datos_usuario["dni"];
                $sexo = $datos_usuario["sexo"];
                $foto = $datos_usuario["foto"]; //la foto la saco de la base de datos
            } else {
                //recojo del $_post

                $nombre = $_POST["nombre"];
                $usuario = $_POST["usuario"];
                $dni = $_POST["dni"];
                $sexo = $_POST["sexo"];
                $foto = $_POST["foto_bd"]; // lo meto en un hidden porque en el $_POST no está
            }
        } else {
            $error_existencia = "<p>El usuario seleccionado no se encuentra en la base de datos</p>";
        }
        if (isset($error_existencia)) {
            echo "<p>Editando el usuario" . $id_usuario . "</p>";
            echo $error_existencia;
            echo "<form action='index.php' method='post'>";
            echo "<p><button type='submit'>Volver</button></p>";
            echo "</form>";
        } else {
            // pongo el formulario
    ?>
            <h2>editando el usuario con id <?php echo $id_usuario ?> </h2>
            <div class="paralelo">
                <form action="index.php" method="post" enctype="multipart/form-data">
                    <p>
                        <label for="nombre">Nombre</label></br>
                        <input type="text" name="nombre" id="nombre" maxlength="50" value="<?php echo $nombre; ?>">
                        <?php
                        if (isset($_POST["btnConEditar"]) && $error_nombre) {
                            if ($_POST["nombre"] == "") {
                                echo "<span class='error'> Campo vacío</span>";
                            } else {
                                echo "<span class='error'> Has tecleado más de 50 caracteres</span>";
                            }
                        }
                        ?>
                    </p>
                    <p>
                        <label for="usuario">Usuario</label></br>
                        <input type="text" name="usuario" id="usuario" maxlength="30" value="<?php echo $usuario; ?>">
                        <?php
                        if (isset($_POST["btnConEditar"]) && $error_usuario) {

                            if ($_POST["usuario"] == "") {
                                echo "<span class='error'> Campo vacío</span>";
                            } elseif (strlen($_POST["usuario"]) > 20) {
                                echo "<span class='error'> Has tecleado más de 20 caracteres</span>";
                            } else {
                                echo "<span class='error'> Usuario repetido</span>";
                            }
                        }
                        ?>
                    </p>
                    <p>
                        <label for="clave">Contraseña</label></br>
                        <input type="password" name="clave" id="clave" maxlength="15"><!--NO pongo value poque no se guarda la contraseña si hay error, la tiene que escribir otra vez-->
                        <?php
                        if (isset($_POST["btnConEditar"]) && $error_clave) {
                            if ($_POST["clave"] == "") {
                                echo "<span class='error'> Campo vacío</span>";
                            } else {
                                echo "<span class='error'> Has tecleado más de 15 caracteres</span>";
                            }
                        }
                        ?>
                    </p>
                    <p>
                        <label for="dni">DNI</label></br>
                        <input type="text" name="dni" id="dni" maxlength="9" value="<?php echo $dni; ?>" />
                        <?php
                        if (isset($_POST["btnContEditar"]) && $error_dni) {
                            if ($_POST["dni"] == "") {
                                echo "<span class='error'> Campo vacío </span>";
                            } elseif (!dni_bien_escrito($dni_may)) {
                                echo "<span class='error'> DNI no está bien escrito </span>";
                            } elseif (!dni_valido($dni_may)) {
                                echo "<span class='error'> DNI no válido </span>";
                            } else {
                                echo "<span class='error'> DNI repetido </span>";
                            }
                        }
                        ?>
                    </p>
                    <p>
                        <label for="sexo">Sexo</label></br>
                        <input type="radio" <?php if ($sexo == "hombre") {
                                                echo 'checked';
                                            }
                                            ?> name="sexo" value="hombre">
                        <label for="hombre">Hombre</label></br>
                        <input type="radio" <?php if ($sexo == "mujer") {
                                                echo 'checked';
                                            }
                                            ?> name="sexo" value="mujer">
                        <label for="mujer">mujer</label>

                    </p>
                    <p>
                        <label for="archivo">Seleccione un archivo imagen(Max 500KB)</label>
                        <input type="file" name="archivo" id="archivo" accept="image/*">
                        <?php
                        // le damos al boton y hay un error....¿pero cual?
                        if (isset($_POST["btnConEditar"]) && $error_archivo) {
                            // si hay un error al subir al servidor (vemos los errores)
                            if ($_FILES["archivo"]["name"] != "") {
                                // si no se almacena correctamente al servidor
                                if ($_FILES["archivo"]["error"]) {
                                    echo "<span class='error'> No se ha podido subir el archivo al servidor</span>";
                                } elseif (!getimagesize($_FILES["archivo"]["tmp_name"])) {

                                    echo "<span class='error'>El archivo seleccionado no es una fotografia</span>";
                                } elseif (!tiene_extension($_FILES["archivo"]["name"])) {
                                    echo "<span class='error'> El archivo que has selecciondo no tienenextension </span>";
                                } else {
                                    // si te pasas de tamanio
                                    echo "<span class='error'> El archivo seleccionado supera los 500 MAX</span>";
                                }
                            }
                        }
                        ?>
                    </p>

                    <p>
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
                        <input type="hidden" name="foto_bd" value="<?php echo $foto ?>">
                        <button type="submit" name="btnConEditar">Continuar</button>
                        <button type="submit">Atrás</button>
                    </p>

            </div>
            <div>
                <p class="centrado">
                    <img class="foto_detalle2" src="Img/<?php echo $foto; ?>" title="Foto de Perfil" alt="Foto de Perfil"><br>
                    <?php
                    if (isset($_POST["btnBorrarFoto"]))
                        echo "¿Estás seguro que quieres borra la foto?<br><br><button name='btnContBorrarFoto'>Si</button><button name='btnNoBorrarFoto'>No</button>";
                    elseif ($foto != "no_imagen.jpg")
                        echo '<button name="btnBorrarFoto">Borrar Foto</button>';
                    ?>

                </p>
            </div>
            </form>
    <?php
     }
    