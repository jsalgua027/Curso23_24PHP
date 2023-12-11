<?php
session_name("ejer_03_23_24");
session_start();

if (isset($_POST["boton"])) {
    if ($_POST["boton"] == "menos") {
        $_SESSION["numero"] = $_SESSION["numero"] - 1;
    }
    if ($_POST["boton"] == "mas") {
        $_SESSION["numero"] = $_SESSION["numero"] + 1;
    }
    if ($_POST["boton"] == "cero") {
        $_SESSION["numero"] = 0;
    }
}
header("Location:sesiones03_1.php");
exit;
?>