<?php
include_once 'Venta.php';
class VentaLocal extends Venta
{
    /*Si la venta es en el local se debe almacenar  un día y  horario para coordinar la entrega del o las bicicleta/s,
    ese día el sector de administración va a contar con toda la documentación lista para otorgar al cliente.

 */
    private $dia;
    private $hora;

    public function __construct($num, $f, $comprador, $arregloBicis, $precio, $pago, $d, $h)
    {
        parent::__construct($num, $f, $comprador, $arregloBicis, $precio, $pago);
        $this->hora = $h;
        $this->dia = $d;
    }

    public function getDia()
    {
        return $this->dia;
    }
    public function getHora()
    {
        return $this->hora;
    }

    public function setDia($d)
    {
        $this->dia = $d;
    }
    public function setHora($h)
    {
        $this->hora = $h;
    }

    public function __toString()
    {
        $cantBicicletas = count($this->getBicicletas());

        $retorno =
            "\nVenta [" . $this->getNumero() .
            "]\nCarrito: \n";
        for ($i = 0; $i < $cantBicicletas; $i++) {
            $retorno .= $this->getBicicletas()[$i];
        }
        $retorno .= "\nPrecio final: $" . $this->getPrecioFinal() . "\n
        Fecha:" . $this->getFecha() . "\n
        Comprador: " . $this->getCliente()."\n
        Forma de pago: ".$this->getFormaPago()."\n
        Dia: ".$this->getDia()."\n
        Hora: ".$this->getHora()." hs.";

        return $retorno;
    }

    /*Implementar la función registrarInformacionVenta($info) que recibe por parámetro un arreglo asociativo $info 
    donde la claves coinciden con el nombre de los atributos necesarios en cada clase ($info[“formapago”] o $info[“direccion”] 
    o $info[“diaemtrega”] son ejemplos de claves necesarios en el array $info). Redefinir el método según crea necesario, 
    en cada clase de la jerarquía. */

    public function registrarInformacionVenta($info)
    {
        $this->setNumero($info["numero"]);
        $this->setFecha($info["fecha"]);
        $this->setCliente($info["cliente"]);
        $this->setBicicletas($info["bicicletas"]);
        $this->setPrecioFinal($info["precio venta"]);
        $this->setFormaPago($info["forma de pago"]);
        $this->setDia($info["dia de retiro"]);
        $this->setHora($info["hora de retiro"]);
    }
    
}
