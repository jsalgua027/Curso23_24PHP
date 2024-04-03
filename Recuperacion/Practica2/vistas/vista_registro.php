<?php

// funcion que te dice la letra del dni en mayuscula
function LetraNIF($dni)
{
    return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
}
//  dni bien escrito: cuando sea de nueve caracteres de numeros y el otro una letra
function dni_bien_escrito($texto)
{
    // devolvemos si tienen nueve caracteres,si los nueve primeros son números y la ultima letra este entre la A y la Z
    return strlen($texto) == 9 && is_numeric(substr($texto, 0, 8)) && substr($texto, -1) >= "A" && substr($texto, -1) <= "Z";
}

function dni_valido($texto)
{
    $numero = substr($texto, 0, 8);
    $letra = substr($texto, -1);
    $valido = LetraNIF($numero) == $letra;
    return $valido;
    // otra forma de hacelor  return LetraNIF(substr($texto, 0, 8)) == substr($texto, -1);
}

//control de errores del registro de ususario normal
if (isset($_POST["btnGuardarRegistro"])) {
    $error_usuario = $_POST["usuario"] == "";
    $error_nombre = $_POST["nombre"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito(strtoupper($_POST["dni"])) || !dni_valido(strtoupper($_POST["dni"]));
    $error_sexo = !isset($_POST["sexo"]);
    $error_boletin = !isset($_POST["boletin"]);
    $error_archivo = $_FILES["foto"]["name"] == "" || $_FILES["foto"]["error"] || explode(".", $_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500 * 1024;/* foto obligatoria */
    $error_form = $error_usuario || $error_nombre || $error_clave || $error_dni || $error_sexo || $error_boletin || $error_archivo;

    if (isset($_POST["btnGuardarRegistro"]) && !$error_form) {
        // aqui tengo que hacer la conexion y subir la foto
    }
}

?>
   
   <!DOCTYPE html>
   <html lang="en">
   <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            color:red
        }
    </style>
   </head>
   <body>
    
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

   </body>
   </html>
   
    <?php
        // esto no es lo que pide
    if(isset($_POST["btnBorrar"])){

        header("Location: index.php");
        exit; // Asegura que el script 

    }

    ?>