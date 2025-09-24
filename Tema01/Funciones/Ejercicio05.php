<?php
$numeros=[1,2,2,3,3,5,6];

$opr=array_filter($numeros,fn($n)=>$n%2===0);

print_r($opr)
?>