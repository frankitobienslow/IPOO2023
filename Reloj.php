<?php
class Reloj
{
    //Atributos
    private $segundos;
    private $horas;
    private $minutos;

    //Constructor
    public function __construct($h, $min, $seg)
    {
        $this->horas = $h;
        $this->segundos = $seg;
        $this->minutos = $min;
    }

    //Observadores
    public function getHoras()
    {
        return $this->horas;
    }

    public function getMinutos()
    {
        return $this->minutos;
    }

    public function getSegundos()
    {
        return $this->segundos;
    }

    //Modificadores
    public function setHoras($h)
    {
        $this->horas = $h;
    }

    public function setMinutos($m)
    {
        $this->minutos = $m;
    }

    public function setSegundos($s)
    {
        $this->segundos = $s;
    }

    //Metodos
    public function puestaACero()
    {
        $this->horas = 0;
        $this->segundos = 0;
        $this->minutos = 0;
    }

    public function incremento()
    {
        $this->segundos++;
        if ($this->segundos == 60) {
            $this->minutos++;
            if ($this->minutos == 60) {
                $this->horas++;
                if ($this->horas == 24) {
                    $this->horas = 0;
                    $this->segundos = 0;
                    $this->minutos = 0;
                }
            }
        }
    }
}
