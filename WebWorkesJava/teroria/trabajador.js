var anterior = 0;
var actual = 1;
var secuencia = "";
// esta funcion concatena la secuencia
function temporizador() {
    
    if (anterior==0) { // no pongo el guión del principio
        secuencia += " " + actual;
    } else {
        secuencia += " - " + actual;
    }
    // envia al worker el mensaje
    postMessage(secuencia);
    //secuencia fibobacci
    aux = anterior + actual;
    anterior = actual;
    actual = aux;
    // cada medio segundo(500) ejecuta la funcion temporizador
    setTimeout("temporizador()", 500);
}
temporizador();