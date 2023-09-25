
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>
   
    <h1>Estos son los datos enviados</h1>
    
    <?php 
    echo "<p><strong>El nombre enviado ha sido:</strong>".$_POST["nombre"]."</p>";
    // nacido es un select solo muestro la selección
    echo "<p><strong>Nacido en:</strong>".$_POST["nacido"]."</p>";
    // controlo el sexo si ha sido o no seleccionado
    if (isset($_POST["sexo"])) {
        echo "<p><strong>Sexo: </strong>" . $_POST["sexo"] . "</p>";
    } else {
        echo "<p><strong>Sexo: </strong>No seleccionado.</p>";
    }
    /*
    // primero controlo que marque uno de los tres
    if (isset($_POST['deportes']) || isset($_POST['lectura']) || isset($_POST['otros'])) {
      
        //tengo que mostar 1.el que sea 2. el que sea   
            // creo un array donde voy a meter los datos para despues mostrarlo por el html
            $aficiones=[];
            $contador=1;
            if (isset($_POST['deportes'])) {
               $aficiones['Deportes']=$_POST['deportes'];
              
            }
            if (isset($_POST['lectura'])) {
                $aficiones['Lectura']=$_POST['lectura'];
               

             }
             if (isset($_POST['otros'])) {
                $aficiones['Otros']=$_POST['otros'];
                
             }
               
             //imprimo el array 
             foreach ($aficiones as $i => $valor) {
                echo "$contador. $i<br>";
                $contador++;
            }

    } else{
            //si no hay aficiones seleccionadas
        echo "<p><strong>No has seleccionado ninguna afición</strong>.</p>";
    }
    */
    if(!isset($_POST['aficiones'])){

        echo"<p><strong>No has selecciona ninguna afición</strong</p>";
    } elseif(count($_POST["aficiones"])==1){
        echo "<p><strong>La aficion seleccionada ha sido:</strong</p>";
        echo"<ol>";
        echo"<li>".$_POST["aficiones"][0]."</li>";
        echo"</ol>";

    }
    else{

        echo "<p><strong>Las aficiones seleccionadas han sido</strong</p>";
        echo"<ol>";
                for ($i=0; $i <count($_POST["aficiones"]) ; $i++) { 
                    echo"<li>".$_POST["aficiones"][$i]."</li>";
                }
        echo"</ol>";


    }
   



    //comentarios
    if ($_POST['coment']!="") {
       echo "<p><strong>El comentario enviado es: </strong>".$_POST['coment']."</p>";
    }else{

        echo "<p><strong>No has echo ningun comentario </strong></p>";
    }

    ?>


</body>
</html>



