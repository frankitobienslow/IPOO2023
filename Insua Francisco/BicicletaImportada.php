<?php
require_once 'Bicicleta.php';
class BicicletaImportada extends Bicicleta{
    
    private $impuesto;
    public function __construct($cod, $cos, $anio, $des, $incAnual, $act,$imp)
    {
        parent::__construct($cod, $cos, $anio, $des, $incAnual, $act);
        $this->impuesto=$imp;
    }

    public function getImpuesto()
    {
        return $this->impuesto;
    }


    public function setImpuesto($porcImp)
    {
        $this->impuesto = $porcImp;
    }

    public function __toString()
    {
        $retorno = "\nCodigo [" . $this->getCodigo() .
            "]\nDescripcion: " . $this->getdescripcion() .
            "\nAño: " . $this->getanio() .
            "\nCosto:" . $this->getCosto() . "(".$this->getImpuesto()."% de impuestos)
            " . $this->getincrementoAnual() . "% de incremento anual)\n";
        if (!$this->getActiva()) {
            $retorno .= "\nSIN STOCK\n\n";
        }
        return $retorno;
    }

    function darPrecioVenta()
    {
        $retorno = 0; //Inicializamos la variable de retorno en 0
        if ($this->getActiva()) {
            $retorno = $this->getCosto() + ($this->getCosto() * ($this->getAnio() * $this->getIncrementoAnual()));
            $retorno+=$retorno/100*$this->getImpuesto();
        }
        return $retorno;
    }
   
}