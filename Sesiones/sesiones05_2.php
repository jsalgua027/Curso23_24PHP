<?php
session_name("ejer_05_23_24");
session_start();

if (isset($_POST["boton"])) {
    if (isset($_POST["boton"]) == "centro") {
        $_SESSION["posicionX"] = 0;
        $_SESSION["posicionY"] = 0;
    }
    if (isset($_POST["boton"]) == "arriba") {
        //restary
        if ($_SESSION["posicionY"] == -200) {
        } else {
            $_SESSION["posicionY"] = $_SESSION["posicionY"] - 20;
            $_SESSION["posicionX"] = $_SESSION["posicionX"] ;
        }
    }
    if (isset($_POST["boton"]) == "abajo") {
        //sumary
        if ($_SESSION["posicionY"] == 200) {
        } else {
            $_SESSION["posicionY"] = $_SESSION["posicionY"] + 20;
            $_SESSION["posicionX"] = $_SESSION["posicionX"] ;
        }
    }
    if (isset($_POST["boton"]) == "izquierda") {
        //restarx
        if ($_SESSION["posicionX"] == -200) {
        } else {
            $_SESSION["posicionX"] = $_SESSION["posicionX"] - 20;
            $_SESSION["posicionY"] = $_SESSION["posicionY"] ;
        }
    }
    if (isset($_POST["boton"]) == "derecha") {
        //sumarx 
        if ($_SESSION["posicionX"] == 200) {
        } else {
            $_SESSION["posicionX"] = $_SESSION["posicionX"] + 20;
            $_SESSION["posicionY"] = $_SESSION["posicionY"] ;

        }
    }
}
header("Location:sesiones05_1.php");
exit;
?>
