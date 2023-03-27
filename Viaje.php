<?php
/*La empresa de Transporte de Pasajeros “Viaje Feliz” quiere registrar la información referente a sus viajes. De cada viaje se precisa almacenar el 
código del mismo, destino, cantidad máxima de pasajeros y los pasajeros del viaje.

Realice la implementación de la clase Viaje e implemente los métodos necesarios para modificar los atributos de dicha clase (incluso los datos de los pasajeros). Utilice un array que almacene la información correspondiente a los pasajeros. Cada pasajero es un array asociativo con las claves “nombre”, “apellido” y “numero de documento”.

Implementar un script testViaje.php que cree una instancia de la clase Viaje y presente un menú que permita cargar la información del viaje, modificar y ver sus datos.

*/
class Viaje
{
    //Atributos
    private $codigo;
    private $destino;
    private $cantMaxPasajeros;
    private $pasajeros;
    private $pasajero;

    //Constructor
    public function __construct($cod, $des, $maxPasajeros)
    {
        $this->codigo = $cod;
        $this->destino = $des;
        $this->cantMaxPasajeros = $maxPasajeros;
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

    //Metodos
    public function agregarPasajero($nombre, $apellido, $dni)
    {
        if ($cantMaxPasajeros >= count($pasajeros)) {
            echo "¡Ya se alcanzó la cantidad máxima de pasajeros!";
        } else {
            $pasajero = array(
                'nombre' => $nombre,
                'apellido' => $apellido,
                'dni' => $dni
            );

            array_push($pasajeros, $pasajero);
        }
    }

    public function mostrarPasajeros()
    {
        foreach ($pasajero as $key => $value) {
        }//mis lentes no son feka xq hacen mal a los ojos
    }
}
