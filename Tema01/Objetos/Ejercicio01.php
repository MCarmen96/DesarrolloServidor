<?php
    class Libro{

        public $titulo;
        public $autor;
        public $year;

        public function mostrarInfo(){

            return "Info libro: ". $this->titulo . $this->autor . $this->year ."\n";        }



    }

    $libro1=new Libro();
    $libro2=new Libro();

    $libro1->titulo="kimetsu no yaiba";
    $libro1->autor="nose";
    $libro1->year=2017;

    $libro2->titulo="El imperio del vampiro";
    $libro2->autor="jay kristof";
    $libro2->year=2020;

    echo $libro1->mostrarInfo();
    echo $libro2->mostrarInfo();



?>