<?php
class Calculadora{
    //Variables
    private $num1;
    private $num2;
    
    //Constructor
    public function __construct($n1,$n2)
    {   
        $this->num1=$n1;
        $this->num2=$n2;
        
    }

    //Modificadores
    public function setNum1($n){
        $num1=$n;
    }
    public function setNum2($n){
        $num1=$n;
    }

    //Observadores
    public function getNum1(){
        return $this->num1;
    }
    public function getNum2(){
        return $this->num2;
    }

    //Metodos
    public function sumar(){
        return $this->num1+$this->num2;
    }
    public function restar(){
        return $this->num1-$this->num2;
    }
    public function multiplicar(){
        return $this->num1*$this->num2;
    
    }
    public function dividir(){
        return $this->num1/$this->num2;
     
    }

}
