<?php

    class Persona{

        public $nombre;
        protected $edad; // SOLO accesible dentro de la propia clase o por clases hijas.
        private $pin;

        public function __construct($nombre,$edad,$pin){
            $this->nombre=$nombre;
            $this->edad=$edad;
            $this->pin=$pin;
        }

        public function getPin(){
            return $this->pin;
        }
        public function getEdad(){
            return $this->edad;
        }

    }

    $persona1=new Persona("albert",29,1111);
    $persona1->nombre="albert";
    

    echo "El PIN de " . $persona1->nombre . " es: " . $persona1->getPin() . "\n";
    echo "La edad de " . $persona1->nombre . " es: " . $persona1->getEdad() . "\n";
    
?>