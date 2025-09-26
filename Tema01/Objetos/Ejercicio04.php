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
        echo "libro creado ";
    }

    

    public function mostrarInfo()
    {

        echo "Info libro: " . $this->titulo . $this->autor . $this->year . "\n";
    }


}

class Revista extends Libro
{

    public $numeroEdicion;

    public function __construct($numeroEdicion,$titulo,$autor,$year){
        parent::__construct($titulo,$autor,$year);
        $this->numeroEdicion=$numeroEdicion;
        echo "revista creada";
    }

     public function mostrarInfo()
    {

        echo "Info libro: {$this->titulo},{$this->autor},{$this->year},{$this->numeroEdicion}  \n";
    }

    
}

$resvita01=new Revista(001,"el jardin de las brusjas","clara taoces",2019);
$libro01=new Libro("kimetsu no yaiba", "nisu",2018);

$misLecturas=[$resvita01,$libro01];

function mostrarColeccion($items){

    foreach($items as $libr){

        $libr->mostrarInfo();

    }
}

mostrarColeccion($misLecturas);


