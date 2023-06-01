<?php
/*Se registra la siguiente información: número, fecha, referencia al cliente, referencia a una colección de bicicletas y el precioFinal final.
 */
class Venta
{
    //Atributos 
    private $numero;
    private $fecha;
    private $cliente;
    private $bicicletas;
    private $precioFinal;
    //Constructor
    public function __construct($num, $f, $comprador, $arregloBicis, $precio)
    {
        $this->numero = $num;
        $this->fecha = $f;
        $this->cliente = $comprador;
        $this->bicicletas = $arregloBicis;
        $this->precioFinal = $precio;
    }
    //Observadores
    public function getNumero()
    {
        return $this->numero;
    }
    public function getFecha()
    {
        return $this->fecha;
    }
    public function getCliente()
    {
        return $this->cliente;
    }
    public function getBicicletas()
    {
        return $this->bicicletas;
    }
    public function getPrecioFinal()
    {
        return $this->precioFinal;
    }

    //Modificadores
    public function setNumero($num)
    {
        $this->numero = $num;
    }
    public function setFecha($f)
    {
        $this->fecha = $f;
    }
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }
    public function setBicicletas($arregloBicis)
    {
        $this->bicicletas = $arregloBicis;
    }
    public function setPrecioFinal($precio)
    {
        $this->precioFinal = $precio;
    }

    //Metodos
    public function __toString()
    {
        $cantBicicletas = count($this->getBicicletas());

        $retorno =
        "\nVenta [" . $this->getNumero() . 
        "]\nCarrito: \n";
        for ($i = 0; $i < $cantBicicletas; $i++) {
            $retorno .= $this->getBicicletas()[$i]->__toString();
        }
        $retorno .= "Precio final: $" . $this->getPrecioFinal() . "\n
        Fecha:" . $this->getFecha() . "\n
        Comprador: " . $this->getCliente() . "\n
        ********************\n";

        return $retorno;
    }

    function incorporarBicicleta($bicicleta)
    {
        $bicicletas=$this->getBicicletas();
        if ($bicicleta->getActiva()) {
            array_push($bicicletas, $bicicleta);
            $this->setBicicletas($bicicletas);
            $this->setPrecioFinal($this->getPrecioFinal() + $bicicleta->darPrecioVenta());
        } else {
            echo "SIN STOCK";
        }
    }
}
