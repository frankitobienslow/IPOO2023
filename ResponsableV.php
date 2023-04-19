<?php
class ResponsableV
{
    //Atributos
    private $nombre;
    private $apellido;
    private $nEmpleado;
    private $licencia;

    //Constructor
    public function __construct($nombreEmpleado, $apellidoEmpleado, $numEmpleado, $numLicencia)
    {
        $this->nombre = $nombreEmpleado;
        $this->apellido = $apellidoEmpleado;
        $this->nEmpleado = $numEmpleado;
        $this->licencia = $numLicencia;
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

    public function getNum()
    {
        return $this->nEmpleado;
    }

    public function getLicencia()
    {
        return $this->licencia;
    }

    //Modificadores
    public function setNombre($nombreEmpleado)
    {
        $this->nombre = $nombreEmpleado;
    }

    public function setApellido($apellidoEmpleado)
    {
        $this->apellido = $apellidoEmpleado;
    }

    public function setNum($numEmpleado)
    {
        $this->nEmpleado = $numEmpleado;
    }

    public function setLicencia($numLicencia)
    {
        $this->licencia = $numLicencia;
    }

    //Metodos
    public function __toString()
    {
        return "N°[" . $this->getNum() . "] " . $this->getNombre() . " " . $this->getApellido() . " Licencia N°: " . $this->getLicencia();
    }
}
