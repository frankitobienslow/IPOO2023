<?php
class Viaje
{
    //Atributos
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros;
    private $pasajerosVIP;
    private $responsableV;
    private $costo;
    private $costosAbonados;
    private $asientos;
    private $millas;

    //Constructor
    public function __construct($cod, $des, $maxPasajeros, $arregloPasajeros, $arregloPasajerosVIP, $responsable,$costoViaje,$costoAbonado,$arregloAsientos,$millasViaje)
    {
        $this->codigo = $cod;
        $this->destino = $des;
        $this->cantMaxPasajeros = $maxPasajeros;
        $this->pasajeros = $arregloPasajeros;
        $this->pasajerosVIP = $arregloPasajerosVIP;
        $this->responsableV = $responsable;
        $this->costo = $costoViaje;
        $this->costosAbonados = $costoAbonado;
        $this->asientos=$arregloAsientos;
        $this->millas = $millasViaje;
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

    public function getCosto()
    {
        return $this->costo;
    }

    public function getCostosAbonados()
    {
        return $this->costosAbonados;
    }

    public function getAsientos()
    {
        return $this->asientos;
    }

    public function getMillas()
    {
        return $this->millas;
    }

    public function getPasajerosVIP()
    {
        return $this->pasajerosVIP;
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

    public function setCosto($cos)
    {
        $this->costo = $cos;
    }

    public function setCostosAbonados($costosAbon)
    {
        $this->costosAbonados = $costosAbon;
    }

    public function setAsientos($arregloAsientos)
    {
        $this->asientos = $arregloAsientos;
    }

    public function setMillas($millasViaje)
    {
        $this->millas = $millasViaje;
    }

    public function setPasajerosVIP($nuevosPasajeros)
    {
        $this->pasajeros = $nuevosPasajeros;
    }
    //Metodos

    public function venderPasaje($pasajero)
    {   
        $retorno=$this->getCosto()+($this->getCosto()*$pasajero->darPorcentajeIncremento())/100;

        $this->setCostosAbonados($this->getCostosAbonados()+$retorno); 

        if($pasajero->darPorcentajeIncremento()>=35){ //Si el pasajero es VIP, se carga en el arreglo de pasajeros VIP
            $pasajerosVIP = $this->getPasajerosVIP();
            array_push($pasajerosVIP, $pasajero);
            $this->setPasajerosVIP($pasajerosVIP);

            $pasajero->setMillas($pasajero->getMillas()+$this->getMillas());//Suma las millas del viaje a las millas que ya tenia
        }
        $colPasajeros = $this->getPasajeros();
        array_push($colPasajeros, $pasajero);
        $this->setPasajeros($colPasajeros);//Agrega el nuevo pasajero y actualiza el arreglo que almacena pasajeros
        return $retorno;
    }

    public function mostrarPasajeros()
    {
        $pasajeros=$this->getPasajeros();
        $retorno = "Lista de pasajeros:\n";
        for ($i = 0; $i < count($pasajeros); $i++) {
            $retorno .= "[" . $i . "] " . $pasajeros[$i]->__toString(). "\n";
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
            case 'asiento':
                $pasajerosActualizados[$n]->setAsiento("valor");
                break;
        }
        $this->setPasajeros($pasajerosActualizados);
    }

    public function __toString()
    {
        return "\n--------------------------------------------\n
        Viaje codigo: " . $this->getCodigo() . "\n
        Responsable:".$this->getResponsable() ."\n
        Destino: " . $this->getDestino() . ".\n
        Capacidad maxima de pasajeros: " . $this->getCantMaxPasajeros() . ".\n". $this->mostrarPasajeros() .".\n
        Costo: $".$this->getCosto()."\n
        Costo abonado (Total recaudado): $".$this->getCostosAbonados().
        "\n--------------------------------------------\n";
    }

public function hayPasajesDisponibles(){
   return (count($this->getPasajeros())<$this->getCantMaxPasajeros());
}

}
