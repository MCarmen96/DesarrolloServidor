<?php

     class Libro{

        public $titulo;
        public $autor;
        public $year;

        public function __construct($titulo,$autor,$year){

            $this->titulo=$titulo;
            $this->autor=$autor;
            $this->year=$year;

        }

        public function __destruct(){
            echo "objeto destruido";
        }
     }
    $libro1=new Libro("jshdfjhs","dfjbj",1233);
    $libro2=new Libro("jshdfjhs","dfjbj",1233);

     echo $libro1->titulo;
     unset($libro1);


?>