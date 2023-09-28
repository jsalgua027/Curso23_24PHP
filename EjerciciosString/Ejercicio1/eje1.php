<?php
    // si hay campos vacios envia el error
    if(isset($_POST["comparar"])){

        // tengo que controlar el tamaño de la palabra
        // lo mejor meterlo  en una variable y de hay generar los errores
        $error_primeraPalabra=$_POST["primera_palabra"]=="";
        $error_segundaPalabra=$_POST["segunda_palabra"]=="";

        $error_form= $error_primeraPalabra||$error_segundaPalabra;
    }
    // si se le da ha comparar y no hay errores
    if(isset($_POST["comparar"])&& !$error_form){

        require "eje1.php";




    }

?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        form{

            background-color: blue;
            border: 1px solid black;

        }
        button{

            background-color: grey;
        }

    </style>
</head>

<body>
    <!--
     Escribe un formulario que pida dos palabras y diga si riman o no. Si
coinciden las tres últimas letras tiene que decir que riman. Si coinciden sólo
las dos últimas tiene que decir que riman un poco y si no, que no riman.
        
-->
    
    <h1>Ripios-Formulario</h1>

    <p>Dime dos palabras y te diré si riman o no</p>
    <p>
        
        <label for="primera_palabra">Primera palabra:</label>
        <input type="text" name="primera" id="primera_palabra" value=""><br />
    </p>
    <p>
        <label for="segunda_palabra">Segunda palabra:</label>
        <input type="text" name="segunda" id="segunda_palabra" value="">
    </p>

    <p>

        <button type="submit" name="comparar">Comparar</button>
    </p>

    </form>
</body>

</html>