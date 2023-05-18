<?php

class Viaje{
    //Atributos 
    private $destino;
    private $horaPartida;
    private $horaLlegada;
    private $numero;
    private $importe;
    private $fecha;
    private $cantAsientos;
    private $cantAsientosDisponibles;
    private $responsable;
    

    //Constructor
    public function __construct($des,$hPartida,$doc,$hLlegada,$imp,$f,$asientos,$asientosDisponibles,$res)
    {
        $this->destino=$des;
        $this->horaPartida=$hPartida;
        $this->horaLlegada=$doc;
        $this->numero=$hLlegada;
        $this->importe=$imp;
        $this->fecha=$f;
        $this->cantAsientos=$asientos;
        $this->cantAsientosDisponibles=$asientosDisponibles;
        $this->responsable=$res;

    }

    //Observadores
    public function getDestino(){
        return $this->destino;
    }
    public function getHoraPartida(){
        return $this->horaPartida;
    }
    public function getHoraLlegada(){
        return $this->horaLlegada;
    }
    public function getNumero(){
        return $this->numero;
    }
    public function getImporte(){
        return $this->importe;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getCantAsientos(){
        return $this->cantAsientos;
    }
    public function getCantAsientosDisponibles(){
        return $this->cantAsientosDisponibles;
    }
    public function getResponsable(){
        return $this->responsable;
    }
    
    //Modificadores
    public function setDestino($des){
        $this->destino=$des;
    }
    public function setHoraPartida($hPartida){
        $this->horaPartida=$hPartida;
    }
    public function setHoraLlegada($horaLlegada){
        $this->horaLlegada=$horaLlegada;
    }
    public function setNumero($num){
        $this->numero=$num;
    }
    public function setImporte($imp){
        $this->importe=$imp;
    }
    public function setFecha($f){
        $this->fecha=$f;
    }
    public function setCantAsientos($asientos){
        $this->cantAsientos=$asientos;
    }
    public function setCantAsientosDisponibles($asientosDisponibles){
        $this->cantAsientosDisponibles=$asientosDisponibles;
    }

    //Metodos    
    public function __toString()
    {
        return 
        "Viaje N[".$this->getNumero()."]\n
        Responsable: ".$this->getResponsable()."\n
        Destino: ".$this->getDestino()."\n
        Fecha: ".$this->getFecha()."\n
        Hora de partida".$this->getHoraPartida()."\n
        Hora de llegada: ".$this->getHoraLlegada()."\n
        Cantidad de asientos disponibles: ".$this->getCantAsientosDisponibles()."\n
        Cantidad de asientos total: ".$this->getCantAsientos()."\n
        Importe: ".$this->getImporte()."\n
        *******************\n";
    }

    public function asignarAsientosDisponibles($cantAsientos){
        $retorno=$cantAsientos<=$this->getCantAsientosDisponibles();
        if($retorno){
            $this->setCantAsientosDisponibles($this->getCantAsientosDisponibles()-$cantAsientos);
        }
        return $retorno;
    }
}