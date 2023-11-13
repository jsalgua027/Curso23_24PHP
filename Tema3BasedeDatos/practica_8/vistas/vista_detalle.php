<?php
    echo "<h3>Detalles del usuario con id: ".$_POST["btnDetalle"]."</h3>";
    try{
        $consulta="select * from usuarios where id_usuario='".$_POST["btnDetalle"]."'";
        $resultado=mysqli_query($conexion, $consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die("<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p></body></html>");
    }




?>