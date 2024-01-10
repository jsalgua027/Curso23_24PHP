<?php
 require "class_fruta.php";

    class Uva extends Fruta{

        private $tieneSemilla;

        public function __construct($nuevo_color,$nuevo_tamanyo,$tiene)
        {
            $this->tieneSemilla=$tiene;
            parent::__construct($nuevo_color,$nuevo_tamanyo);



        }

        public function tienenSemilla(){
            return $this->tieneSemilla;

        }






    }




?>