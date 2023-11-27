<?php
 try {
    $conexion=mysqli_connect("localhost","jose","josefa","bd_exam_colegio");
    mysqli_set_charset($conexion,"utf8");
 } catch (Exception $e) {
    mysqli_close($conexion);

     die(error_page("Examen Notas","<h1>Notas de los Alumnos</h1><p>No he podido conectarse a la base de batos: " . $e->getMessage() .  "</p></body></html>"));
 }

 try {
    $consulta="select * from alumnos";
    $resultado= mysqli_query($conexion,$consulta);
 } catch (Exception $e) {
    die(error_page("Examen Notas", "Practica Examen   <h1>Notas de los Alumnos</h1><p>en estos momentos no tenemos ningun alumno registrado en  la base de batos: " . $e->getMessage() .  "</p></body></html>"));
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index Principal</title>
</head>
<body>
    <h1>Notas de los alumnos</h1>
    <?php 
    if(mysqli_num_rows($resultado) > 0){
       
        echo" <form action='index.php' method='post'>";
        echo"<p>";
        echo"<label for='alumno'>Seleccione un alumno</label>"; 
        echo "<select name='alumno' id='alumno'>";
        while ($tupla=mysqli_fetch_assoc($resultado)) {

             if(isset($_POST["alumno"]) && $_POST["alumno"]==$tupla["cod_alu"]){
                echo "  <option selected value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";
                $nombre_alumno=$tupla["nombre"];
             }else{
                echo "  <option select value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";
             }
           
        }
          echo"</select>";
           echo" <button type='submit' name='btnVerNotas'>Ver Notas</button>  ";
           echo"</p>";
        echo"</form>";
        if(isset($_POST["btnVerNotas"])){
            echo"<h2>Notas del alumno: ".$nombre_alumno."</h2>";
          
          //SELECT asignaturas.cod_asig, asignaturas.denominacion, notas.nota FROM asignaturas, notas WHERE asignaturas.cod_asig AND notas.cod_alu=2; 
          //Consulta de las notas que no tiene rellenas: select * from asignaturas where cod_asig not in (select asignaturas.cod_asig from asignaturas,notas where asignaturas.cod_asig=notas.cod_asig and notas.cod_alu=2);
        }
      
    }else{
        die("<h1>Notas de los Alumnos</h1><p>en estos momentos no tenemos ningun alumno registrado en  la base de batos: " . $e->getMessage() .  "</p></body></html>");
    }
    ?>
          
</body>
</html>



 <?php
?>

