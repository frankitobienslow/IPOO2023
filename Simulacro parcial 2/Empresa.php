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
            "Empresa " . $this->getNombre() . "]
        ID[" . $this->getId() . "]
        Viajes: " . $this->getViajes();
    }

    public function buscarViaje($codViaje)
    {
        $cantViajes = count($this->getViajes());
        $i = 0;
        $retorno = null;
        do {
            if ($this->getViajes()[$i]->getCodigo() == $codViaje) {
                $retorno = $this->getViajes()[$i];
            } else {
                $i++;
            }
        } while ($retorno == null && $i < $cantViajes);
        return $retorno;
    }
}
