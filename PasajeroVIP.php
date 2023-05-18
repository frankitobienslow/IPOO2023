<?php
require_once "Pasajero.php";
class PasajeroVIP extends Pasajero
{
    //Atributos
    private $numViajeroFrecuente;
    private $millas;

    //Constructor
    public function __construct($nombrePasajero, $apellidoPasajero, $nDni, $nTel, $nAsiento, $nTicket, $nViajeroFrecuente, $nMillas)
    {
        parent::__construct($nombrePasajero, $apellidoPasajero, $nDni, $nTel, $nAsiento, $nTicket);
        $this->millas = $nMillas;
        $this->numViajeroFrecuente = $nViajeroFrecuente;
    }

    //Observadores
    public function getMillas()
    {
        return $this->millas;
    }

    public function getNViajeroFrecuente()
    {
        return $this->numViajeroFrecuente;
    }

    //Modificadores
    public function setMillas($nMillas)
    {
        $this->millas=$nMillas;
    }

    public function setNViajeroFrecuente($nViajeroFrecuente)
    {
        $this->numViajeroFrecuente=$nViajeroFrecuente;
    }


    //Metodos 
    public function __toString()
    {
        $retorno="Ticket N° ".$this->getTicket()." N° Viajero frecuente: ".$this->getNViajeroFrecuente()." ".$this->getNombre() . " " . $this->getApellido() . " DNI: " . $this->getDni() . " Asiento N° ".$this->getAsiento(). " Telefono: " . $this->getTelefono(). " Millas: ".$this->getMillas();
        return $retorno;
    }

    public function darPorcentajeIncremento(){
        if($this->getMillas()>300){
            $retorno=65;
        }else{
            $retorno=35;
        }
        return $retorno;
     }
}

