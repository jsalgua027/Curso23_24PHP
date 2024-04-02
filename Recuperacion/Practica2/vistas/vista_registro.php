
    <h1>Práctica Rec 2</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"] ?>">
            <?php
                if(isset($_POST["btnGuardarRegistro"])&& $error_usuario){
                    echo "<span class='error'>*Campo obligatorio*</span>";
                }
            ?>
        </p>
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"] ?>">
            <?php
                if(isset($_POST["btnGuardarRegistro"])&& $error_nombre){
                    echo "<span class='error'>*Campo obligatorio*</span>";
                }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" >
            <?php
                    if (isset($_POST["btnGuardarRegistro"]) && $error_clave) {
                        echo "<span class='error'>*Campo Obligatorio*</span>";
                    }
                    ?>
        </p>
        <p>
        <label for="dni">DNI:</label>
                    <input type="text" name="dni" id="dni" value="<?php if (isset($_POST["dni"])) echo $_POST["dni"] ?>">
                    <?php
                    if (isset($_POST["btnGuardarRegistror"]) && $error_dni) {
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
            <label for="sexo">Sexo:</label><br/>
            <input type="radio" id="hombre" name="sexo" value="hombre"  <?php if(isset($_POST["sexo"])&& $_POST["sexo"]=="hombre") echo "checked"?>>
            <label for="hombre">Hombre:</label><br/>
            <input type="radio" id="mujer" name="sexo" value="mujer" <?php if(isset($_POST["sexo"])&& $_POST["sexo"]=="mujer") echo "checked"?>>
            <label for="mujer">Mujer:</label>
            <?php
                if(isset($_POST["btnGuardarRegistro"])&& $error_sexo){
                    echo "<span class='error'>*Campo obligatorio*</span>";
                }
            ?>
        </p>
        <p>
            Incluir mi foto (Max 500KB)
            <input type="file" id="archivo" name="archivo">
            <?php
                    if (isset($_POST["btnGuardarRegistro"]) && $error_archivo) {
                        
                            if ($_FILES["archivo"]["name"] == "") {
                                echo " <span class='error'> debes de seleccionar un archivo</span>";
                            }
                            else if ($_FILES["archivo"]["error"]) {
                                echo " <span class='error'> No se ha podido subir el archivo al servidor</span>";
                            } elseif (!getimagesize($_FILES["archivo"]["tmp_name"])) {

                                echo " <span class='error'>El archivo subido debe de ser una imagen </span>";
                            } elseif(!explode(".",$_FILES["archivo"]["name"])) {
                                echo " <span class='error'> El archivo tiene que tener extension</span>";
                            }else{
                                echo " <span class='error'> El archivo seleccionado supera los 500 KB MAX</span>";
                            }
                        }
                    
                    ?>
        </p>
        <p>
            <input type="checkbox" id="boletin" name="boletin"  >
            Subcribirme al boletín de novedades
        </p>
        <p>
            <button type="submit" name="btnGuardarRegistro" value="guardar">Guardar Cambios</button>
            <button type="submit"  name="btnBorrar" value="borrar">Borrar los datos introducidos</button>
        </p>
    </form>

    <?php
        // esto no es lo que pide
    if(isset($_POST["btnBorrar"])){

        header("Location: index.php");
        exit; // Asegura que el script 

    }

    ?>