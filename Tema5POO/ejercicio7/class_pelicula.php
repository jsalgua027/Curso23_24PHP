<?php 
    class Pelicula{
        private $nombre;
        private $director;
        private $precio;
        private $alquilada;
        private $fecha_prev_devolucion;
        private $recargo;

        function __construct($nombre,$director,$precio,$alquilada,$fecha_prev_devolucion)
        {
            $this->nombre=$nombre;
            $this->director=$director;
            $this->precio=$precio;
            $this->alquilada=$alquilada;
            $this->fecha_prev_devolucion=new DateTime($fecha_prev_devolucion);

        }

        



        /**
         * Get the value of nombre
         */
        public function getNombre()
        {
                return $this->nombre;
        }

        /**
         * Set the value of nombre
         */
        public function setNombre($nombre)
        {
                $this->nombre = $nombre;

                return $this;
        }

        /**
         * Get the value of director
         */
        public function getDirector()
        {
                return $this->director;
        }

        /**
         * Set the value of director
         */
        public function setDirector($director)
        {
                $this->director = $director;

                return $this;
        }

        /**
         * Get the value of precio
         */
        public function getPrecio()
        {
                return $this->precio;
        }

        /**
         * Set the value of precio
         */
        public function setPrecio($precio)
        {
                $this->precio = $precio;

                return $this;
        }

        /**
         * Get the value of alquilada
         */
        public function getAlquilada()
        {
                return $this->alquilada;
        }

        /**
         * Set the value of alquilada
         */
        public function setAlquilada($alquilada)
        {
                $this->alquilada = $alquilada;

                return $this;
        }

        /**
         * Get the value of fecha_prev_devolucion
         */
        public function getFechaPrevDevolucion()
        {
                return $this->fecha_prev_devolucion->format('d/m/y');
        }

        /**
         * Set the value of fecha_prev_devolucion
         */
        public function setFechaPrevDevolucion($fecha_prev_devolucion)
        {
                $this->fecha_prev_devolucion = new DateTime($fecha_prev_devolucion);

                return $this;
        }

        /**
         * Get the value of recargo
         */
        public function getRecargo()
        {
                return $this->recargo;
        }

        /**
         * Set the value of recargo
         */
        public function setRecargo($recargo)
        {
                $this->recargo = $recargo;

                return $this;
        }

        function calcularRecargo(){
            $fecha_actual= new DateTime('now');
            if($fecha_actual> $this->fecha_prev_devolucion){
                $dif_dias=$fecha_actual->diff($this->fecha_prev_devolucion);
                $this->recargo=1.2 * $dif_dias->days;
            }else{
                $this->recargo=0;
            }
            return $this->recargo;
        }


    }
?>