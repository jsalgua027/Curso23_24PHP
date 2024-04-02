
        <h1>Práctica Rec 2</h1>
        <form action="index.php" method="post">

            <p>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" value="<?php if (isset($_POST["btnEntrar"])) echo $_POST["usuario"] ?>">
                <?php
                if (isset($_POST["btnEntrar"]) && $error_usuario) {

                    echo "<span class='error'> Este campo es obligatorio</span>";
                }
                ?>
            </p>

            <p>
                <label for="clave">Contraseña:</label>
                <input type="password" id="clave " name="clave">
                <?php
                if (isset($_POST["btnEntrar"]) && $error_clave) {

                    echo "<span class='error'> Este campo es obligatorio</span>";
                }
                ?>
            </p>

            <p>
                <button type="submit" name="btnEntrar" value="entrar">Entrar</button>
                <button type="submit" name="btnRegistro" value="registro">Registrarse</button>
            </p>

        </form>

 
