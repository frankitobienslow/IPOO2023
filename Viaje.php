<?php
/*La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. De cada viaje se precisa almacenar el 
código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.

Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase (incluso los datos de los pasajeros). Utilice un array que almacene la información correspondiente a los pasajeros. Cada pasajero es un array asociativo con las claves “nombre”, “apellido” y “numero de documento”.



*/
class Viaje
{
    //Atributos
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros;

    //Constructor
    public function __construct($cod, $des, $maxPasajeros)
    {
        $this->codigo = $cod;
        $this->destino = $des;
        $this->cantMaxPasajeros = $maxPasajeros;
        $this->pasajeros = [];
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

    //Metodos

    public function agregarPasajero($nombre, $apellido, $dni)
    {
        $pasajero = array(
            'nombre' => $nombre,
            'apellido' => $apellido,
            'dni' => $dni
        );
        array_push($this->pasajeros, $pasajero);
    }

    public function mostrarPasajeros()
    {
        $retorno = "Lista de pasajeros: ";
        for ($i = 0; $i < count($this->pasajeros); $i++) {
            $retorno .= "\n[" . $i . "] " . $this->pasajeros[$i]['nombre'] . " " . $this->pasajeros[$i]['apellido'] . " DNI: " . $this->pasajeros[$i]['dni'] . "\n";
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
        $pasajerosActualizados[$n][$clave] = $valor;
        $this->setPasajeros($pasajerosActualizados);
    }

    public function __toString()
    {
        return "\n--------------------------------------------\n
        Viaje codigo: " . $this->getCodigo() . "\n
        Destino: " . $this->getDestino() . ".\n
        Capacidad maxima de pasajeros: " . $this->getCantMaxPasajeros() . ".\n" . $this->mostrarPasajeros().
        "--------------------------------------------\n";
    }
}
