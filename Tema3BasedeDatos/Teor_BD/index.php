<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría Base de Datos</title>
    <style>
        .erro{

            color: red;
        }
        table, th, td{border: 1px solid black;}

        table{border-collapse: collapse;width: 80%; margin: 0 auto; text-align: center;}

        th{ background-color: lightgray;}


    </style>
</head>
<body>
        
        <?php
            // primero me logeo y me conecto
            // 4 argumentos, direccion,nombre, usuario, contraseña,base de datos

            try {
                $conexion=mysqli_connect("localhost","jose","josefa","bd_teoria");
                // traduce los caracteres de la base de datos a nuestro codigo; hay que hacerlo 
                mysqli_set_charset($conexion,"utf8");
            } catch (Exception $e) {
                 // cerramos la conexión
                 mysqli_close($conexion);
                //si no logro conectarme
                                                                        //OJO el die termina todo y necesita un fin de body y de html
                die("<p class='error'>No he podido conectarme a la base de datos: ".$e->getMessage()." </p></body></html>");
            }
            //genero la variable que hace la consulta a la base de datos
            $consulta="select * from t_alumnos"; 
            try {
               // le paso la consulta al metodo y guardo la consulta en el resultado
               $resultado= mysqli_query($conexion,$consulta);

            } catch (Exception $e) {
                 // cerramos la conexión
                 mysqli_close($conexion);
                die("<p class='error'>No he podido conectarme a la base de datos: ".$e->getMessage()." </p></body></html>");
            }
            // hemos realizado la conexion y la consulta correcta
            

            // obtengo el numero de duplas obtenido
             $n_tuplas=mysqli_num_rows($resultado);

             echo"<p> El numero de tuplas obtentidos es: ".$n_tuplas."</p>";

            // meto el alumno en un arry asociativo 
            $tupla=mysqli_fetch_assoc($resultado);
            echo"<p>El primer alumno obtenido tienen el nombre: ".$tupla["nombre"]."</p>";


            // meto el alumno en un arry escalar 
            $tupla=mysqli_fetch_row($resultado);
            echo"<p>El segundo alimno obtenido tienen el nombre: ".$tupla[1]."</p>";

            // te trae todo el array asociativo y el escalar 
            $tupla=mysqli_fetch_array($resultado);
            echo"<p>El tercer alumno obtenido tienen el nombre: ".$tupla["nombre"]."</p>";
            echo"<p>El tercer alumno obtenido tienen el nombre: ".$tupla[1]."</p>";


            /* // como hay tres alumnos vuelvo al principio

            mysqli_data_seek($resultado,0);

            // me traigo el objeto por propiedades
            $tupla=mysqli_fetch_object($resultado);
            echo"<p>El cuarto alumno alumno obtenido tienen el nombre: ".$tupla->nombre."</p>";

           */ 
           
            // comienzo desde cero que solo hay tres alumnos
            mysqli_data_seek($resultado,0);

            echo"<table>";
                echo"<tr><th>Codigo</th><th>Nombre</th><th>Telefono</th><th>Cod.Postal</th></tr>";

                while ($tupla=mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo"<td>".$tupla["cod_alu"]."</td>";
                    echo"<td>".$tupla["nombre"]."</td>";
                    echo"<td>".$tupla["telefono"]."</td>";
                    echo"<td>".$tupla["cp"]."</td>";
                    echo "</tr>";
                }
            echo"</table>";
            

            // libero despues de hacer la consulta
            mysqli_free_result($resultado);




            // cerramos la conexión
            mysqli_close($conexion);
        ?>    
</body>
</html>