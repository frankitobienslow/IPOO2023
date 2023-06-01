<?php

class Cliente
{
    //Atributos 
    private $nombre;
    private $apellido;
    private $nroDoc;
    private $tipoDoc;
    private $dadoDeBaja;
    //Constructor
    public function __construct($nom, $ap, $doc, $tDoc, $deBaja)
    {
        $this->nombre = $nom;
        $this->apellido = $ap;
        $this->nroDoc = $doc;
        $this->tipoDoc = $tDoc;
        $this->dadoDeBaja = $deBaja;
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
    public function getDoc()
    {
        return $this->nroDoc;
    }
    public function getTipoDoc()
    {
        return $this->tipoDoc;
    }
    public function getBaja()
    {
        return $this->dadoDeBaja;
    }

    //Modificadores
    public function setNombre($nom)
    {
        $this->nombre = $nom;
    }
    public function setApellido($ap)
    {
        $this->apellido = $ap;
    }
    public function setNroDoc($nDoc)
    {
        $this->nroDoc = $nDoc;
    }
    public function setTipoDoc($tDoc)
    {
        $this->tipoDoc = $tDoc;
    }
    public function setBaja($deBaja)
    {
        $this->dadoDeBaja = $deBaja;
    }

    //Metodos
    public function __toString()
    {
        $retorno = $this->getNombre() . " " . $this->getApellido() . " " . $this->getTipoDoc() . ": " . $this->getDoc() . "\n";

        if ($this->getBaja()) {
            $retorno .= "DADO DE BAJA\n";
        };
        $retorno .= "\n";
        return $retorno;
    }
}
