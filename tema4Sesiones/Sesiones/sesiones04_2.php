<?php
session_name("ejer_04_23_24");
session_start();
    if(isset($_POST["boton"])){
        if($_POST["boton"]=="menos"){
            if($_SESSION["posicion"]==-300 ){

            }else{
                $_SESSION["posicion"]=  $_SESSION["posicion"]-20;
            }
           
        }
        if($_POST["boton"]=="mas"){

         if($_SESSION["posicion"]==300){

            }else{
                $_SESSION["posicion"]=  $_SESSION["posicion"]+20;
            }
        }
        if($_POST["boton"]=="centro"){
            $_SESSION["posicion"]=  0;
        }


    }
    header("Location:sesiones04_1.php");
    exit;

?>