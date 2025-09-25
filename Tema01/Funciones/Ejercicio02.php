<?php

$arrayNumbers=[1,2,3,4,5,6];

function calcularPromedio($array):int{
    $leng=count($array);
    $suma=array_sum($leng,$array);
    $promedio=$suma/$leng;
    return $promedio;

}

echo "FUNCION NORMAL POR VALOR: ". calcularPromedio($arrayNumbers);

$promedio=function ($array):int{
    $leng=count($array);
    $suma=array_sum($leng,$array);
    $promedio=$suma/$leng;
    return $promedio;
}
echo "FUNCION ANONIMA EN VARIABLE ". $promedio($arrayNumbers);

$leng=count($arrayNumbers);
$suma=array_sum($leng,$array);
$calcularPromedioFlecha=fn ($leng,$suma):int => $suma/$leng;

echo "FUNCION FELCHA " . $calcularPromedioFlecha($leng,$suma);

