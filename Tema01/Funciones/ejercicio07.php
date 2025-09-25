<?php
    $nombres=["carmen","lucky","alberto","luis"];

    $coonvertMayus=function($array){

        $mayus=array_map("strtoupper",$array);

        return $mayus;
    };
    
    print_r($coonvertMayus($nombres));

?>