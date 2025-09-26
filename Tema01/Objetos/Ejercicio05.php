<?php

interface Prestable{
    function prestar();
    function devolver();
    function estaPrestado();

}

class Libro implements Prestable{

    public $titulo;
    public $autor;
    public $year;
    public $prestado=false;

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

    public function prestar(){ 
        

        if($this->prestado==true){
            echo "--El libro que quieres ya esta prestado.Coge otro--";
        }else{
            $this->prestado=true;
            echo "has prestado el libro durante una semana";
        }
    }
    public function devolver(){}
    public function estaPrestado()
    {
        
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

$libro01->prestar();
$resvita01->prestar();


