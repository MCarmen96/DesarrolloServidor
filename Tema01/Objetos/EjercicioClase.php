<?php

    class Persona{

        public $nombre;
        protected $edad;
        private $pin;

        public function __construct($nombre,$edad,$pin){
            $this->nombre=$nombre;
            $this->edad=$edad;
            $this->pin=$pin;
        }

        public function getPin(){
            return $this->pin;
        }

    }

    $persona1=new Persona();
    $persona1->nombre="albert";
    
    echo $persona1->getPin();
    echo $persona1->getEdad();

?>