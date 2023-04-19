<?php
//Atributos
class Pasajero
{
    private $nombre;
    private $apellido;
    private $dni;
    private $telefono;

    //Constructor
    public function __construct($nombrePasajero, $apellidoPasajero, $nDni, $nTel)
    {
        $this->nombre = $nombrePasajero;
        $this->apellido = $apellidoPasajero;
        $this->dni = $nDni;
        $this->telefono = $nTel;
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

    //Metodos
    public function __toString()
    {
        return $this->getNombre() . " " . $this->getApellido() . " DNI: " . $this->getDni() . " Telefono: " . $this->getTelefono();
    }
}
