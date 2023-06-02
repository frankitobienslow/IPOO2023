<?php
class Responsable
{
    //Atributos 
    private $nombre;
    private $apellido;
    private $dni;
    private $direccion;
    private $email;
    private $telefono;
    //Constructor
    public function __construct($nom, $ap, $doc, $dir, $mail, $tel)
    {
        $this->nombre = $nom;
        $this->apellido = $ap;
        $this->dni = $doc;
        $this->direccion = $dir;
        $this->email = $mail;
        $this->telefono = $tel;
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
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getTelefono()
    {
        return $this->telefono;
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
    public function setDni($dni)
    {
        $this->dni = $dni;
    }
    public function setDireccion($dir)
    {
        $this->direccion = $dir;
    }
    public function setEmail($mail)
    {
        $this->email = $mail;
    }
    public function setTelefono($tel)
    {
        $this->telefono = $tel;
    }

    //Metodos
    public function __toString()
    {
        return $this->getNombre() . " " . $this->getApellido() . "
            DNI: " . $this->getDni() . "
            Telefono: " . $this->getTelefono() . "
            Email: " . $this->getEmail() . "
            Direccion: " . $this->getDireccion() . "";
    }
}
