<?php
// por si no hay conexión , la realizo
if (!isset($conexion)) {
  try {
    $conexion = mysqli_connect("localhost", "jose", "josefa", "bd_cv");
    mysqli_set_charset($conexion, "utf8");
  } catch (Exception $e) {
    die("<p>No ha podido conectarse a la base de batos: " . $e->getMessage() . "</p></body></html>");
  }
}
// realizo la consulta

try {
  $consulta = "select * from usuarios";
  $resultado = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
  die("<p>No se ha podido hacer la consulta: " . $e->getMessage() . "</p></body></html>");
}
// si le doy ha borrar



echo "<h3>Lista de Usuarios</h3>";

echo "<table>";
echo "<tr><th>#</th><th>Foto</th><th>Nombre</th><th><form action='index.php' method='post'><button class='enlace' type='submit'  name='btnNuevoUsu'>Usuario+</button></form></th></tr>";
while ($tupla = mysqli_fetch_assoc($resultado)) {
  echo "<tr>";
  echo "<td>" . $tupla["id_usuario"] . "</td>";
  echo "<td><img src='Img/" . $tupla["foto"] . "' name='foto' title='foto perfil'></td>";
  echo "<td><form action='index.php' method='post'><button class='enalce' type='submit' value='" . $tupla["id_usuario"] . "' name='btnDetalle'>" . $tupla["nombre"] . "</button></form></td>";
  echo "<td><form action='index.php' method='post'><input type='hidden' name='nombre_foto' value='".$tupla["foto"]."'><button class='enalce' type='submit' value='" . $tupla["id_usuario"] . "' name='btnBorrar'>Borrar</button>" . " - " . "
   <button class='enalce' type='submit' value='" . $tupla["id_usuario"] . "' name='btnEditar'>Editar</button>
   </form></td>";
  echo "</tr>";
}
echo "</table>";
