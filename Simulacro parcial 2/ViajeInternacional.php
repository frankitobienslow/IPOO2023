<?php
require_once "Viaje.php";
class ViajeInternacional extends Viaje
{
    private $impuestos;
    private $docOficial;

    public function __construct($des, $hPartida, $doc, $hLlegada, $imp, $f, $asientos, $asientosDisponibles, $res, $docOf)
    {
        parent::__construct($des, $hPartida, $doc, $hLlegada, $imp, $f, $asientos, $asientosDisponibles, $res);
        $this->impuestos = 10;
        $this->docOficial = $docOf;
    }

    public function getImpuestos()
    {
        return $this->impuestos;
    }

    public function getDocOficial()
    {
        return $this->docOficial;
    }


    public function setImpuesto($porcImp)
    {
        $this->impuestos = $porcImp;
    }

    public function setDocOficial($docOfi)
    {
        $this->docOficial = $docOfi;
    }

    public function __toString()
    {
        $retorno =
            "Viaje N[" . $this->getNumero() . "]
        Responsable: " . $this->getResponsable() . "
        Destino: " . $this->getDestino() . "
        Fecha: " . $this->getFecha() . "
        Hora de partida" . $this->getHoraPartida() . "
        Hora de llegada: " . $this->getHoraLlegada() . "
        Cantidad de asientos disponibles: " . $this->getCantAsientosDisponibles() . "
        Cantidad de asientos total: " . $this->getCantAsientos() . "
        Monto base: " . $this->getMonto() . "
        Impuestos: " . $this->getImpuestos() . "%\n";

        if ($this->getDocOficial()) {
            $retorno .= "REQUIERE DOCUMENTACION OFICIAL\n";
        }
        $retorno .= "*******************\n\n";
    }
}
