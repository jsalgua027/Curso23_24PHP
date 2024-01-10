<?php
//hacer una clase
class Fruta
{
    private $color, $tamanyo;
    private static $n_frutas = 0;
    //constructor parametrizado
    public function __construct($color_nuevo, $tamanyo_nuevo)
    {
        $this->color = $color_nuevo;
        $this->tamanyo = $tamanyo_nuevo;
        //lamada a la variable estatica
        self::$n_frutas++;
    }
    public function __destruct() //metodo reservado para cuando eliminas el objeto __destruct()
    {

        self::$n_frutas--;
    }
    // metodo estatico para saber cuantas hay
    public static function cuantasFrutas()
    {
        return self::$n_frutas;
    }
    //setters

    public function set_color($color_nuevo)
    {
        $this->color = $color_nuevo;
    }
    //getters
    public function set_tamanyo($tamanyo_nuevo)
    {
        $this->tamanyo = $tamanyo_nuevo;
    }

    public function get_color()
    {
        return $this->color;
    }

    public function get_tamanyo()
    {
        return $this->tamanyo;
    }

    private function imprimir()
    {
        echo "<p>color: " . $this->get_color() . "</p><br><p>Tamanio: " . $this->get_tamanyo() . "</p>";
    }
}
