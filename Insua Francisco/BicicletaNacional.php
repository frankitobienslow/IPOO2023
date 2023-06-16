<?php
require_once 'Bicicleta.php';
class BicicletaNacional extends Bicicleta
{
    private $descuento;
    public function __construct($cod, $cos, $anio, $des, $incAnual, $act, $desc)
    {
        parent::__construct($cod, $cos, $anio, $des, $incAnual, $act);
        $this->descuento = $desc;
    }

    public function getDescuento()
    {
        return $this->descuento;
    }

    public function setDescuento($desc)
    {
        $this->descuento = $desc;
    }

    public function __toString()
    {
        $retorno = "\nCodigo [" . $this->getCodigo() .
            "]\nDescripcion: " . $this->getdescripcion() .
        "\nAño: " . $this->getanio() .
            "\nCosto:" . $this->getCosto() . "(" . $this->getDescuento() . "% de descuento)
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
            $retorno -= $retorno / 100 * $this->getDescuento();
        }
        return $retorno;
    }
}
