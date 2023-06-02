<?php
require_once "Viaje.php";
class ViajeNacional extends Viaje
{
    private $descuento;

    public function __construct($des, $hPartida, $doc, $hLlegada, $imp, $f, $asientos, $asientosDisponibles, $res)
    {
        parent::__construct($des, $hPartida, $doc, $hLlegada, $imp, $f, $asientos, $asientosDisponibles, $res);
        $this->descuento = 10;
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
        return
            "Viaje N[" . $this->getNumero() . "]
        Responsable: " . $this->getResponsable() . "
        Destino: " . $this->getDestino() . "
        Fecha: " . $this->getFecha() . "
        Hora de partida" . $this->getHoraPartida() . "
        Hora de llegada: " . $this->getHoraLlegada() . "
        Cantidad de asientos disponibles: " . $this->getCantAsientosDisponibles() . "
        Cantidad de asientos total: " . $this->getCantAsientos() . "
        Monto base: " . $this->getMonto() . "
        Descuento: " . $this->getDescuento() . "%
        *******************\n\n";
    }
}
