<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Ejercicio 8</h1>
    <?php
            //creo un array de nombres y lo muesto cada elemento en una lisa no numerada

            $nombres = array("Pedro", "Ismael", "Sonia", "Clara", "Susana", "Alfonso", "Teresa");
            echo "<ul>";
            for ($i = 0; $i < count($nombres); $i++) {
                echo "<li>" . $nombres[$i] . "</li>";

            }
            echo "</ul>";
    ?>

</body>
</html>