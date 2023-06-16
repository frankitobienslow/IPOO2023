<?php

class Bicicleta
{
    //Atributos 
    private $codigo;
    private $costo;
    private $anio;
    private $descripcion;
    private $incrementoAnual;
    private $activa;
    //Constructor
    public function __construct($cod, $cos, $anio, $des, $incAnual, $act)
    {
        $this->codigo = $cod;
        $this->costo = $cos;
        $this->anio = $anio;
        $this->descripcion = $des;
        $this->incrementoAnual = $incAnual;
        $this->activa = $act;
    }
    //Observadores
    public function getCodigo()
    {
        return $this->codigo;
    }
    public function getCosto()
    {
        return $this->costo;
    }
    public function getanio()
    {
        return $this->anio;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getIncrementoAnual()
    {
        return $this->incrementoAnual;
    }
    public function getActiva()
    {
        return $this->activa;
    }


    //Modificadores
    public function setCodigo($cod)
    {
        $this->codigo = $cod;
    }
    public function setCosto($cos)
    {
        $this->costo = $cos;
    }
    public function setAnio($anio)
    {
        $this->anio = $anio;
    }
    public function setDescripcion($des)
    {
        $this->descripcion = $des;
    }
    public function setincrementoAnual($incAnual)
    {
        $this->incrementoAnual = $incAnual;
    }
    public function setActiva($act)
    {
        $this->activa = $act;
    }

    //Metodos
    public function __toString()
    {
        $retorno = "\nCodigo [" . $this->getCodigo() .
            "]\nDescripcion: " . $this->getdescripcion() .
        "\nAño: " . $this->getanio() .
            "\nCosto:" . $this->getCosto() .
            " (" . $this->getincrementoAnual() . "% de incremento anual)\n";
        if (!$this->getActiva()) {
            $retorno .= "SIN STOCK\n\n";
        }
        return $retorno;
    }

    function darPrecioVenta()
    {
        $retorno = -1; //Inicializamos la variable de retorno en -1
        if ($this->getActiva()) {
            $retorno = $this->getCosto() + ($this->getCosto() * ($this->getAnio() * $this->getIncrementoAnual()));
        }
        return $retorno;
    }
}
