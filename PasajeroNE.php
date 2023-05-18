<?php
require_once "Pasajero.php";
class PasajeroNE extends Pasajero
{
    //Atributos
   private $requiereSilla;
   private $requiereAsistencia;
   private $requiereComidaEspecial;

    //Constructor
    public function __construct($nombrePasajero, $apellidoPasajero, $nDni, $nTel, $nAsiento, $nTicket,$silla,$asistencia,$comidaEspecial)
    {
        parent::__construct($nombrePasajero, $apellidoPasajero, $nDni, $nTel, $nAsiento, $nTicket);
        $this->requiereSilla=$silla;
        $this->requiereAsistencia=$asistencia;
        $this->requiereComidaEspecial=$comidaEspecial;

    }

    //Observadores
    public function getRequiereSilla()
    {
        return $this->requiereSilla;
    }

    public function getRequiereAsistencia()
    {
        return $this->requiereAsistencia;
    }

    public function getRequiereComidaEspecial()
    {
        return $this->requiereComidaEspecial;
    }

    //Modificadores
    public function setRequiereSilla($silla)
    {
        $this->requiereSilla=$silla;
    }

    public function setRequiereAsistencia($asistencia)
    {
        $this->requiereAsistencia=$asistencia;
    }

    public function setRequiereComidaEspecial($comidaEspecial)
    {
        $this->requiereComidaEspecial=$comidaEspecial;
    }

    //Metodos

    public function __toString()
    {
        $retorno="Ticket N° ".$this->getTicket()." ".$this->getNombre() . " " . $this->getApellido() . " DNI: " . $this->getDni() . " Asiento N° ".$this->getAsiento(). " Telefono: " . $this->getTelefono();
        if($this->getRequiereSilla()){
            $retorno.=" -Requiere silla de ruedas";
        }
        if($this->getRequiereAsistencia()){
            $retorno.=" -Requiere asistencia";
        }
        if($this->getRequiereComidaEspecial()){
            $retorno.=" -Requiere comida especial";
        }
        return $retorno;
    }

     public function darPorcentajeIncremento(){
        $i=0;
        $retorno=10;
        if($this->getRequiereSilla()){
            $i++;
        }
        if($this->getRequiereAsistencia()){
            $i++;
        }
        if($this->getRequiereComidaEspecial()){
            $i++;
        }
        if($i==1){
            $retorno=15;
        }else if($i>1){
            $retorno=30;
        }

        return $retorno;
     }
}
