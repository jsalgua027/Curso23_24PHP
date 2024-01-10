<?php
    class Empleado{

        private $nombre;
        private $sueldo;

        public function __construct($sueldo_nuevo, $nombre_nuevo)
        {
            $this->sueldo=$sueldo_nuevo;
            $this->nombre=$nombre_nuevo;
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
        public function setNombre($nombre_nuevo)
        {
                $this->nombre = $nombre_nuevo;

                return $this;
        }

        /**
         * Get the value of sueldo
         */
        public function getSueldo()
        {
                return $this->sueldo;
        }

        /**
         * Set the value of sueldo
         */
        public function setSueldo($sueldo_nuevo)
        {
                $this->sueldo = $sueldo_nuevo;

                return $this;
        }


        public function impuestos(){
            $valor=3000;
   
            echo "<p>El empleado <strong>".$this->nombre."</strong>
             con sueldo ".$this->sueldo." ";
   
           if($this->sueldo >$valor){
   
               echo " tiene que pagar impuestos";
   
           }else
               echo " no require de pagar impuestos";
   
   
           echo "</p>";
   
   
       }


    }


?>