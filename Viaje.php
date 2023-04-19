<?php

class Viaje
{
    //Atributos
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros;
    private $responsableV;

    //Constructor
    public function __construct($cod, $des, $maxPasajeros, $responsable)
    {
        $this->codigo = $cod;
        $this->destino = $des;
        $this->cantMaxPasajeros = $maxPasajeros;
        $this->pasajeros = [];
        $this->responsableV = $responsable;
    }

    //Destructor
    public function __destruct()
    {
    }

    //Observadores
    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getDestino()
    {
        return $this->destino;
    }

    public function getCantMaxPasajeros()
    {
        return $this->cantMaxPasajeros;
    }

    public function getPasajeros()
    {
        return $this->pasajeros;
    }

    public function getResponsable(){
        return $this->responsableV;
    }

    //Modificadores
    public function setCodigo($cod)
    {
        $this->codigo = $cod;
    }

    public function setDestino($des)
    {
        $this->destino = $des;
    }

    public function setCantMaxPasajeros($maxPasajeros)
    {
        $this->cantMaxPasajeros = $maxPasajeros;
    }

    public function setPasajeros($nuevosPasajeros)
    {
        $this->pasajeros = $nuevosPasajeros;
    }

    public function setResponsable($empleado)
    {
        $this->responsableV = $empleado;
    }

    //Metodos

    public function agregarPasajero($pasajero)
    {
        array_push($this->pasajeros, $pasajero);
    }

    public function mostrarPasajeros()
    {
        $retorno = "Lista de pasajeros:\n";
        for ($i = 0; $i < count($this->pasajeros); $i++) {
            $retorno .= "[" . $i . "] " . $this->pasajeros[$i]->__toString(). "\n";
        }
        return $retorno;
    }

    public function eliminarPasajero($n)
    {
        $this->setPasajeros(array_splice($this->pasajeros, ($n - 1), 1)); //Elimina el pasajero y actualiza el arreglo $pasajeros
    }

    public function modificarPasajero($n, $clave, $valor)
    {
        $pasajerosActualizados = $this->getPasajeros();
        switch ($clave) {
            case 'nombre':
                $pasajerosActualizados[$n]->setNombre("valor");
                break;
            case 'apellido':
                $pasajerosActualizados[$n]->setApellido("valor");
                break;
            case 'dni':
                $pasajerosActualizados[$n]->setDni("valor");
                break;
            case 'telefono':
                $pasajerosActualizados[$n]->setTelefono("valor");
                break;
        }
        $this->setPasajeros($pasajerosActualizados);
    }

    public function __toString()
    {
        return "\n--------------------------------------------\n
        Viaje codigo: " . $this->getCodigo() . "\n
        Responsable:".$this->getResponsable()->__toString()."\n
        Destino: " . $this->getDestino() . ".\n
        Capacidad maxima de pasajeros: " . $this->getCantMaxPasajeros() . ".\n". $this->mostrarPasajeros() .
        "\n--------------------------------------------\n";
    }
}
