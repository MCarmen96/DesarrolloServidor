<?php

use PHPUnit\Framework\TestCase;
use app\Calculadora;


class CalculadoraTest extends TestCase{


    public function testSumar(){
        $calcu=new Calculadora();
        $this->assertEquals(5,$calcu->sumar(2,3));
    }

    public function testResta(){
        $calcu=new Calculadora();
        $this->assertEquals(5,$calcu->sumar(2,3));
    }

    public function testDividirPorCero(){
        $calcu=new Calculadora();
        $this->expectException(InvalidArgumentException::class);
        $calcu->dividir(4,0);
    }

}