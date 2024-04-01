    <?php
   // require("../src/funciones.php");
  /*Pendiente el control de errores */
   if(isset($_POST["btnGuardarRegistro"]))
   {
       echo "<p>Estoy en la comprobacion de errores</p>";
   
   }
    ?>
    <h1>Estoy en el registro</h1>
    <h1>Práctica Rec 2</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" value="">
        </p>
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="">
        </p>
        <p>
            <label for="clave">Contraseña:</label>
            <input type="password" id="clave" name="clave" value="">
        </p>
        <p>
            <label for="dni">Dni:</label>
            <input type="text" id="dni" name="dni" value="">
        </p>
        <p>
            <label for="sexo">Sexo:</label><br/>
            <input type="radio" id="hombre" name="sexo" value="hombre">
            <label for="hombre">Hombre:</label><br/>
            <input type="radio" id="mujer" name="sexo" value="mujer">
            <label for="mujer">Mujer:</label>
        </p>
        <p>
            Incluir mi foto (Max 500KB)
            <input type="file" id="foto" name="foto">
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
