<?php

class Libro
{

    public $titulo;
    public $autor;
    public $year;

    public function __construct($titulo, $autor, $year)
    {

        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->year = $year;
    }

    public function __destruct()
    {
        echo "objeto destruido";
    }

    public function mostrarInfo()
    {

        return "Info libro: " . $this->titulo . $this->autor . $this->year . "\n";
    }

}

class Revista extends Libro
{

    public $numeroEdicion;

    public function __construct($numeroEdicion,$titulo,$autor,$year){
        parent::__construct($titulo,$autor,$year);
        $this->numeroEdicion=$numeroEdicion;
    }

    
}


