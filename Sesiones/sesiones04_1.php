<?php
session_name("ejer_04_23_24");
session_start();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        svg{width: 600px;height: 20px; border: 1px solid black;}
    </style>
</head>

<body>

    <form action="sesiones04_2.php" method="post">

    <p>
        <button type="submit" name="boton" value="mas">👉</button>   <button type="submit" name="boton" value="menos">👈</button>
    </p>
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewbox="-300 0 600 20">
        <line x1="-300" y1="10" x2="300" y2="10" stroke="black" stroke-width="5" />
        <circle cx="0" cy="10" r="8" fill="red" />
    </svg>
    </form>
    
</body>

</html>