/*
    Crea un trait identificable que aporte una propiedad id y los metodos setId y getId().
    Haz que tanto libro como revsita usen este trait, y asigna un ID unico al crearlos.
*/

<?php

    trait Identificacion{
        protected $id;

        public function getId(){return $this->id;}
        public function setId($id){$this->id=$id;}
    }

//clase abstracta
abstract class MaterialBiblioteca{

    public $titulo;
    public $autor;
    public $year;

    abstract public function mostrarInfo();

    public function esAntiguo(){

        $isOld=false;

        if($this->year<2000){

            echo "El libro es antiguo";
            $isOld=true;

        }else{

            echo "El libro no es antiguo";
        }

        return $isOld;
    }


}

interface Prestable{
    function prestar();
    function devolver();
    function estaPrestado();

}

class Libro extends MaterialBiblioteca implements Prestable{ // usa los metodos de la interfaz

    use Identificacion;
    public $prestado=false;


    public function __construct($titulo, $autor, $year)
    {
        parent::__construct($titulo, $autor, $year);
        echo "libro creado ";
    }

    public function mostrarInfo()
    {

        echo "Info libro: " . $this->titulo . $this->autor . $this->year . "\n";
    }

    public function prestar(){ 
        
        if($this->prestado){
            echo "--El libro que quieres ya esta prestado.Coge otro--";
        }else{
            $this->prestado=true;
            echo "has prestado el libro durante una semana";
        }
    }

    public function devolver(){}
    public function estaPrestado(){}

    //getters y setters
    public function getTitulo(){return $this->titulo;}
    public function setTitulo($titulo){$this->titulo=$titulo;}

    public function getAutor(){return $this->autor;}
    public function setAutor($autor){$this->autor=$autor;}

    public function getYear(){return $this->year;}
    public function setYear($year){

        if($year>date("Y")){
            echo "El año no puede ser mayor al actual";
            $this->year=2025;
        }else{
            echo "el año es correcto";
        }
    }



}

class Revista extends MaterialBiblioteca implements Prestable{

    public $numeroEdicion;
    public $prestado=false;

    public function __construct($numeroEdicion,$titulo,$autor,$year){
        parent::__construct($titulo,$autor,$year);
        $this->numeroEdicion=$numeroEdicion;
        echo "revista creada";
    }

    public function mostrarInfo()
    {
        echo "Info libro: {$this->titulo},{$this->autor},{$this->year},{$this->numeroEdicion}  \n";
    }

    public function prestar(){ 
        
        if($this->prestado){
            echo "--El libro que quieres ya esta prestado.Coge otro--";
        }else{
            $this->prestado=true;
            echo "has prestado el libro durante una semana";
        }
    }

    public function devolver(){}
    public function estaPrestado(){}
}

$resvita01=new Revista(001,"el jardin de las brusjas","clara taoces",2019);
$libro01=new Libro("kimetsu no yaiba", "nisu",2018);

$misLecturas=[$resvita01,$libro01];

$libro01->setYear(2026);

function mostrarColeccion($items){

    foreach($items as $libr){
        $libr->mostrarInfo();
    }
}

mostrarColeccion($misLecturas);

$libro01->prestar();
$resvita01->prestar();


