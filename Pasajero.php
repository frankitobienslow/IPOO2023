<?php
//Atributos
class Pasajero
{
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;
    private $asiento;
    private $ticket;

    //Constructor
    public function __construct($nombrePasajero, $apellidoPasajero, $nDni, $nTel, $nAsiento, $nTicket)
    {
        $this->nombre = $nombrePasajero;
        $this->apellido = $apellidoPasajero;
        $this->dni = $nDni;
        $this->telefono = $nTel;
        $this->asiento=$nAsiento;
        $this->ticket=$nTicket;
    }

    //Destructor
    public function __destruct()
    {
    }

    //Observadores
    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getDni()
    {
        return $this->dni;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function getAsiento()
    {
        return $this->asiento;
    }

    public function getTicket()
    {
        return $this->ticket;
    }

    //Modificadores
    public function setNombre($nombrePasajero)
    {
        $this->nombre = $nombrePasajero;
    }

    public function setApellido($apellidoPasajero)
    {
        $this->apellido = $apellidoPasajero;
    }

    public function setDni($nDni)
    {
        $this->dni = $nDni;
    }

    public function setTelefono($nTel)
    {
        $this->telefono = $nTel;
    }

    public function setAsiento($nAsiento)
    {
        $this->asiento = $nAsiento;
    }

    public function setTicket($nTicket)
    {
        $this->ticket = $nTicket;
    }
    
    //Metodos
    public function __toString()
    {
        return "Ticket N° ".$this->getTicket()." ".$this->getNombre() . " " . $this->getApellido() . " DNI: " . $this->getDni() . " Asiento N° ".$this->getAsiento(). " Telefono: " . $this->getTelefono();
    }

    public function darPorcentajeIncremento(){
        return 10;
     }

}
