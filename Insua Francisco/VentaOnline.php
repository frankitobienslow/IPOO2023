<?php
include_once 'Venta.php';
class VentaOnline extends Venta
{
    /*Si la venta es on-line se debe almacenar: dirección de envío, DNI de quien recepciona la entrega 
    y número de teléfono de contacto. Además hay que tener en cuenta para estas ventas, 
    un costo de transporte que va a afectar al importe total de la venta, produciendo un incremento del un 15%. 
 */
    private $direccion;
    private $dni;
    private $contacto;

    public function __construct($num, $f, $comprador, $arregloBicis, $precio, $pago, $dir, $nDoc, $tel)
    {
        parent::__construct($num, $f, $comprador, $arregloBicis, $precio += ($precio * 15) / 100, $pago);
        $this->dni = $nDoc;
        $this->direccion = $dir;
        $this->contacto = $tel;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getDni()
    {
        return $this->dni;
    }
    public function getContacto()
    {
        return $this->contacto;
    }

    public function setDireccion($dir)
    {
        $this->direccion = $dir;
    }

    public function setDni($nDoc)
    {
        $this->dni = $nDoc;
    }

    public function setContacto($tel)
    {
        $this->contacto = $tel;
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
        Comprador: " . $this->getCliente() . "\n
        Forma de pago: " . $this->getFormaPago() . "\n
        DNI Recepcionista: " . $this->getDni() . "\n
        Direccion de entrega: " . $this->getDireccion() . "\n
        Telefono de contacto: " . $this->getContacto();

        return $retorno;
    }

    public function registrarInformacionVenta($info)
    {
        $this->setNumero($info["numero"]);
        $this->setFecha($info["fecha"]);
        $this->setCliente($info["cliente"]);
        $this->setBicicletas($info["bicicletas"]);
        $this->setPrecioFinal($info["precio venta"]);
        $this->setFormaPago($info["forma de pago"]);
        $this->setDireccion($info["direccion"]);
        $this->setDni($info["dni recepcionista"]);
        $this->setContacto($info["telefono de contacto"]);
    }
}
