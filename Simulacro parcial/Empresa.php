<?php

class Empresa
{
    //Atributos 
    private $id;
    private $nombre;
    private $viajes;

    //Constructor
    public function __construct($identificacion, $nom, $arregloViajes)
    {
        $this->id = $identificacion;
        $this->nombre = $nom;
        $this->viajes = $arregloViajes;
    }

    //Observadores
    public function getId()
    {
        return $this->id;
    }
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getViajes()
    {
        return $this->viajes;
    }

    //Modificadores
    public function setId($identificacion)
    {
        $this->id = $identificacion;
    }

    public function setNombre($nom)
    {
        $this->nombre = $nom;
    }

    public function setViajes($arregloViajes)
    {
        $this->viajes = $arregloViajes;
    }

    //Metodos    
    public function __toString()
    {
        return
            "Empresa " . $this->getNombre() . "]\n
        ID[" . $this->getId() . "]\n
        Viajes: " . $this->getViajes()->__toString() . "\n";
    }

    public function mostrarViajesAlDestino($destino)
    {
        $listaViajes = "";
        for ($i = 0; $i < count($this->getViajes()); $i++) {
            if (strcasecmp($this->getViajes()[$i]->getDestino(), $destino) == 0) {
                $listaViajes .= $this->getViajes()[$i]->__toString();
            }
        }
        if ($listaViajes != "") {
            $retorno = "Viajes a " . $destino . "\n
            *******************\n"
                . $listaViajes;
        } else {
            $retorno = "No se han encontrado viajes con destino a " . $destino . ".";
        }
        return $retorno;
    }

    function incorporarViaje($viaje)
    {
        $i = 0;
        $cantViajes = count($this->getViajes());
        $retorno = true;
        do {
            if (
                $this->getViajes()[$i]->getDestino() == $viaje->getDestino() &&
                $this->getViajes()[$i]->getFecha() == $viaje->getFecha() &&
                $this->getViajes()[$i]->getHoraPartida() == $viaje->getHoraPartida()
            ) {
                $i = $cantViajes;
                $retorno = false;
            } else {
                $i++;
            }
        } while ($retorno);
        if ($retorno) {
            $this->setViajes(array_push($this->getViajes(), $viaje));
        }
        return $retorno;
    }

    public function venderViaje($cantAsientos, $destino, $fecha)
    {
        $i = 0;
        $cantViajes = count($this->getViajes());
        do {
            if (
                $this->getViajes()[$i]->getDestino() == $destino &&
                $this->getViajes()[$i]->getFecha() == $fecha
            ) {
                if ($this->getViajes()[$i]->asignarAsientosDisponibles($cantAsientos)) {
                    $retorno = $this->getViajes()[$i];
                }
            } else {
                $i++;
            }
        } while ($i < $cantViajes && $retorno == null);
        return $retorno;
    }

    function montoRecaudado()
    {
        $cantViajes = count($this->getViajes());
        $retorno = 0;
        for ($i = 0; $i < $cantViajes; $i++) {
            $retorno += ($this->getViajes()[$i]->getAsientos() - ($this->getViajes()[$i]->getAsientos() - $this->getViajes()[$i]->getAsientosDisponibles())) * $this->getViajes()[$i]->getImporte();
            $i++;
        }
        return $retorno;
    }
}
