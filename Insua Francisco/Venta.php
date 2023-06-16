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
    private $formaPago;
    //Constructor
    public function __construct($num, $f, $comprador, $arregloBicis, $precio, $pago)
    {
        $this->numero = $num;
        $this->fecha = $f;
        $this->cliente = $comprador;
        $this->bicicletas = $arregloBicis;
        $this->precioFinal = $precio;
        $this->formaPago = $pago;
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
    public function getFormaPago()
    {
        return $this->formaPago;
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
    public function setFormaPago($pago)
    {
        $this->formaPago = $pago;
    }

    //Metodos
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
        Comprador: " . $this->getCliente() . "\n
        Forma de pago: " . $this->getFormaPago();

        return $retorno;
    }

    function incorporarBicicleta($bicicleta)
    {
        $bicicletas = $this->getBicicletas();
        if ($bicicleta->getActiva()) {
            array_push($bicicletas, $bicicleta);
            $this->setBicicletas($bicicletas);
            $this->setPrecioFinal($this->getPrecioFinal() + $bicicleta->darPrecioVenta());
        } else {
            echo "SIN STOCK";
        }
    }

    function retornarTotalVentaNacional()
    {
        $retorno = 0;
        $cantBicicletas = count($this->getBicicletas());
        for ($i = 0; $i < $cantBicicletas; $i++) {
            if ($this->getBicicletas()[$i]instanceof BicicletaNacional) {
                $retorno += $this->getBicicletas()[$i]->darPrecioVenta();
            }
        }

        return $retorno;
    }

    function retornarBicicletasImportadas()
    {
        /*Implementar el método informarVentasImportadas() que recorre la colección de ventas realizadas por la empresa y 
        retorna una colección de ventas de bicicletas  importadas.
        Si en la venta al menos una de las bicicletas es importada la venta debe ser informada. */
        $retorno = [];
        $cantBicicletas = count($this->getBicicletas());
        for ($i = 0; $i < $cantBicicletas; $i++) {
            if ($this->getBicicletas()[$i] instanceof BicicletaImportada) {
                array_push($retorno, $this->getBicicletas()[$i]);
            }
        }
        return $retorno;
    }
}
