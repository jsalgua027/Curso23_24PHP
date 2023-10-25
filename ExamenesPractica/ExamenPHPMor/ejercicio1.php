<?php
function isSubcadena($texto, $cadenaABuscar)
{
	for ($i = 0; $i <= strlen($texto) - strlen($cadenaABuscar); $i++) {

		$igual = false; //lo inicializo a false

		if ($texto[$i] == $cadenaABuscar[0]) { //si ambas son iguales, es candidata
			$igual = true;

			for ($j = 0; $j < strlen($cadenaABuscar); $j++) { //recorremos la longitud de la palabra
				//si son iguales no pasara nada
				if ($texto[$i + $j] != $cadenaABuscar[$j]) {
					//si salta que son diferentes las letrtas comprobadas, salta "false" y termina el bucle
					$igual = false;
					break;
				}
			}
		}
		//cuando termian el bucle, si todo a sidop igual sera true, por lo tanto terminara el for principal
		if ($igual) return true;

		//ultima posicion donde podemos buscar, si no ha salido del bucle, significa que no es subcadena
		if ($i == strlen($texto) - strlen($cadenaABuscar)) return false;

		//sino vuelta a empezar hasta que termine el texto
	}
}

if (isset($_POST["comprobar"])) {
	$errorTexto = $_POST["texto"] == "";
	$errorSubcadena = $_POST["subcadena"] == "" || strlen($_POST["subcadena"]) > strlen($_POST["texto"]);
	$errores = $errorTexto || $errorSubcadena;
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Ejercicio 1</title>
	<meta charset="utf-8" />
	<style>
		.error {
			color: red;
		}
	</style>
</head>

<body>
	<h1>Ejercicio 1</h1>
	<form action="ejercicio1.php" method="post">
		<p>
			<label for="palabra">Introduce palabra:</label>
			<input type="text" name="texto" id="palabra" value="<?php if (isset($_POST["texto"])) echo $_POST["texto"]; ?>" />
			<?php
			if (isset($_POST["comprobar"]) && $errorTexto) {
				echo "<span class='error'>*Campo obligatorio*</span>";
			}
			?>
		</p>
		<p>
			<label for="subpalabra">Introduce letras:</label>
			<input type="text" name="subcadena" id="subpalabra" value="<?php if (isset($_POST["subcadena"])) echo $_POST["subcadena"]; ?>" />
			<?php
			if (isset($_POST["comprobar"]) && $errorSubcadena) {
				if ($_POST["subcadena"] == "")
					echo "<span class='error'>*Campo obligatorio*</span>";
				else
					echo "<span class='error'>*Imposible que este contenida en el texto anterior(este texto es mayor que el anterior)*</span>";
			}
			?>
		</p>
		<p>
			<button type="submit" name="comprobar">Comprobar</button>
		</p>
	</form>

	<?php
	if (isset($_POST["comprobar"]) && !$errores) {

		if (isSubcadena($_POST["texto"], $_POST["subcadena"])) echo "Es cadena";
		else echo "No es subcadena";
	}
	?>
</body>

</html>