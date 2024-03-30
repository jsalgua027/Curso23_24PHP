<h1>Segundo Formulario</h1>
<form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>">
            <?php
            if(isset($_POST["btnEnviar"]) && $error_nombre)
            {
                echo "<span class='error'>*Campo obligatorio*</span>";

            } 
            
            ?>
        </p>
        <p>
            Nacido en:
            <select name="ciudades" id="ciudades">
                <option value="malaga"<?php if(isset($_POST["ciudades"])&& $_POST["ciudades"]=="malaga") echo"selected";?>>Málaga</option>
                <option value="cadiz"<?php if(isset($_POST["ciudades"])&& $_POST["ciudades"]=="cadiz") echo"selected";?>>Cádiz</option>
                <option value="almeria"<?php if(isset($_POST["ciudades"])&& $_POST["ciudades"]=="almeria") echo"selected";?>>Almeria</option>
            </select>
        </p>
        <p>
            Sexo:
            <label for="hombre" id="sexo">Hombre</label>
            <input type="radio" id="hombre" name="sexo" value="hombre"<?php if(isset($_POST["sexo"])&& $_POST["sexo"]=="hombre") echo"checked";?>>
            <label for="mujer" id="sexo">Mujer</label>
            <input type="radio" id="mujer" name="sexo" value="mujer"<?php if(isset($_POST["sexo"])&& $_POST["sexo"]=="mujer") echo"checked";?>>
            <?php
            if(isset($_POST["btnEnviar"])&&$error_sexo){
                echo "<span class='error'>*Campo obligatorio*</span>";
            }
            
            ?>
        </p>
        <p>
            Aficiones:
            <label for="deportes">Deportes</label>
            <input type="checkbox" id="deportes" name="aficiones[]" value="deportes" <?php if(isset($_POST["aficiones"])&& in_array("deportes",$_POST["aficiones"]))echo"checked";?>>
            <label for="lectura">Lectura</label>
            <input type="checkbox" id="lectura" name="aficiones[]" value="lectura" <?php if(isset($_POST["aficiones"])&& in_array("lectura",$_POST["aficiones"]))echo"checked";?>>
            <label for="otros">Otros</label>
            <input type="checkbox" id="otros" name="aficiones[]" value="otros" <?php if(isset($_POST["aficiones"])&& in_array("otros",$_POST["aficiones"]))echo"checked";?>>
        </p>

        <p>
            Comentarios:
            <textarea id="comentarios" name="comentarios"><?php if(isset($_POST["comentarios"])) echo $_POST["comentarios"]?></textarea>
            <?php
            if(isset($_POST["btnEnviar"])&& $error_comentarios)
            {
                echo "<span class='error'>*Campo obligatorio*</span>";
            }
            ?>
        </p>
        <p>
            Incluir mi foto (Archivo de tipo imagen Máx 500KB):
            <input type="file" id="foto" name="foto" value="foto">
            <?php
                if(isset($_POST["btnEnviar"])&& $error_foto){ // si al darle a enviar y hay un error 
                    //si no se ha seleccionado el archivo
                    if($_FILES["foto"]["name"]=="")
                    {
                        echo "<span class='error'>No se ha seleccionado Archivo</span>";
                    }
                  //si no se ha podido subir el archivo
                  elseif($_FILES["foto"]["error"])
                  {
                    echo "<span class='error'>No se ha podido subir el archivo</span>";
                  }
                    //si el archivo no es una imagen
                elseif(!getimagesize($_FILES["foto"]["tmp_name"]))
                {
                    echo "<span class='error'>El archivo no es una imagen</span>";
                }
                    //si el archivo no tienen extensión
                    elseif(!explode(".",$_FILES["foto"]["name"]))
                {
                    echo "<span class='error'>El archivo tiene que tener extensión</span>";
                }
                    //si el archivo supera el tamaño indicado
                else{
                    echo "<span class='error'>El archivo supera el tamaño indicado</span>"; 
                }
                }
            
            
            ?>
        </p>

        <p>
        <input type="submit"  name="btnEnviar" value="Enviar">
            <input type="submit"  name="btnBorrar" value="Borrar Campos">
    </form>