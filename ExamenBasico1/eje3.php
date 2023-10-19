<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- 
    Realizar una página php con nombre ejercicio3.php, que contenga un
formulario con un campo de texto, un select y un botón. Este botón al
pulsarse, nos va a modificar la página respondiendo cuántas palabras hay
en el cuadro de texto según el separador seleccionado en el select
(“,”,”;”,”(espacio)“,”:”)
Se hará un control de error cuando en el cuadro de texto no se haya
introducido nada


    -->
</head>
<body>
    <form action="eje3.php" method="post" enctype="multipart/form-data">
        <label for="frase">Escriba una frase</label>
        <input type="text" name="frase" id="frase" value="">
        <select name="separacion" id="separacion">
            <option value=",">,</option>
            <option value=";">;</option>
            <option value=" ">espacio</option>
            <option value=":">:</option>
            
        </select>

        <button type="submit" name="comprobar">Comprobar</button>
    </form>
</body>
</html>