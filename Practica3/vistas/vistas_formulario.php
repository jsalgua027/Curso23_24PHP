<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            .error {
                color: red
            }
        </style>
    </head>

    <body>
        <form action="index.php" method="post" enctype="multipart/form-data">
            <!-- get envia y muestra post envia y oculta en el url para realizar pruebas se usa el get-->

            <h1>Rellena tu CV</h1>
            <p> <label for="nombre">Nombre </label> </br> <!--label para que si pinchas en el p te lleve al input-->
                <input type="text" name="nombre" id="nombre" value="<?php if (isset($_POST['nombre'])) { // si hay valor se envia
                                                                                                        echo $_POST['nombre'];
                                                                                                        } ?>" /> <!--Tengo que añadir el name para que mande el valor -->
                <!--  se añade eñ value para que recupere el valor ya metido-->
                
                <?php
                    // si le damos al boton y nos salta error porque esta vacio (error controlado en el index)
                if (isset($_POST["guardar"]) && $error_nombre) {
                    echo "<span class='error'>Campo vacio </span>";
                }


                ?>


            </p>
            <p><label for="Apellidos">Apellidos </label> </br>
                <input type="text" name="apellidos" id="apellidos" value="<?php if (isset($_POST['apellidos'])){
                                                                                                                 echo $_POST['apellidos'] ;
                                                                                                                 }?>" />

                <?php

                if (isset($_POST["guardar"]) && $error_apellidos) {
                    echo "<span class='error'>Campo vacio </span>";
                }


                ?>


            </p>
            <p><label for="clave">Clave </label> </br>
                <input type="password" name="clave" id="clave" /> <!--No le metemos value para que siempre tenga que meterlo-->

                <?php

                if (isset($_POST["guardar"]) && $error_clave) {
                    echo "<span class='error'>Campo vacio </span>";
                }


                ?>


            </p>

            <p>Sexo</br> <!-- fundamental poner el value para que se sepa el valor de la seleccion en la url-->
                <?php

                if (isset($_POST["guardar"]) && $error_sexo) {
                    echo "<span class='error'>Debe de seleccionar un sexo </span> </br>";
                }


                ?>
                <!-- Aqui el if (isset) lo uso sin llaves cuando es solo una sentencia en una linea-->
                <input type="radio" <?php if (isset($_POST['sexo']) && $_POST['sexo']=='hombre') echo 'checked'; ?> name="sexo" id="hombre" value="hombre" /> <label for="hombre">Hombre</label></br>
                <input type="radio" <?php if (isset($_POST['sexo']) && $_POST['sexo']=='mujer') echo 'checked'; ?> name="sexo" id="mujer" value="mujer" /> <label for="mujer">Mujer</label> <!-- checked para que salga seleccionado por defecto -->
            </p>
            <p>
                <label for="foto">Incluir foto</label>
                <input type="file" name="foto" id="foto" accept="image/*"> <!--accept es para que solo acepte imagenes -->
            </p>
            <p>
                <label for="nacido">Nacido en:</label>
                <select name="nacido" id="nacido">
                    <!--Gestiono para se quede seleccionado la primera decisión del usuario por si no completa otras opciones pues  no tenga que elegir otra vez esta opcion -->
                    <option value="malaga" <?php if( (isset($_POST['nacido']) && $_POST['nacido']=='malaga')) {
                                                                                                                 echo 'selected';
                                                                                                                 }?> >Malaga</option> <!-- selected para que salga seleccionado por defecto -->
                    <option value="cadiz"<?php if((isset($_POST['nacido']) && $_POST['nacido']=='cadiz')){ 
                                                                                                            echo 'selected';
                                                                                                            }?>>Cadiz</option>
                    <option value="sevilla"<?php if(!isset($_POST['nacido']) || (isset($_POST['nacido']) && $_POST['nacido']== 'sevilla')) {
                                                                                                                            echo 'selected';
                                                                                                                                }?>>Sevilla</option>

                </select>


            </p>

            <p>
                <label for="comentarios">Comentarios</label>

                <textarea id="comentarios" name="comentarios" <?php if (isset($_POST['comentarios'])) echo $_POST['comentarios']; ?>></textarea>

                <?php

                if (isset($_POST["guardar"]) && $error_comentarios) {
                    echo "<span class='error'>Campo vacio </span>";
                }


                ?>


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