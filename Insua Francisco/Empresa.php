<?php
/*Se registra la siguiente información: dedeninación, dirección, la colección de clientes, colección de bicicletas 
y la colección de ventas realizadas.
 */
class Empresa
{
    //Atributos 
    private $denominacion;
    private $direccion;
    private $clientes;
    private $bicicletas;
    private $ventas;
    //Constructor
    public function __construct($den, $dir, $compradores, $arregloBicicletas, $arregloVentas)
    {
        $this->denominacion = $den;
        $this->direccion = $dir;
        $this->clientes = $compradores;
        $this->bicicletas = $arregloBicicletas;
        $this->ventas = $arregloVentas;
    }
    //Observadores
    public function getDenominacion()
    {
        return $this->denominacion;
    }
    public function getDireccion()
    {
        return $this->direccion;
    }
    public function getClientes()
    {
        return $this->clientes;
    }
    public function getBicicletas()
    {
        return $this->bicicletas;
    }
    public function getVentas()
    {
        return $this->ventas;
    }

    //Modificadores
    public function setDenominacion($den)
    {
        $this->denominacion = $den;
    }
    public function setDireccion($dir)
    {
        $this->direccion = $dir;
    }
    public function setClientes($compradores)
    {
        $this->clientes = $compradores;
    }
    public function setBicicletas($arregloBicicletas)
    {
        $this->bicicletas = $arregloBicicletas;
    }
    public function setVentas($arregloVentas)
    {
        $this->ventas = $arregloVentas;
    }

    //Metodos
    public function __toString()
    {
        $cantClientes = count($this->getClientes());
        $cantBicicletas = count($this->getBicicletas());
        $cantVentas = count($this->getVentas());

        $retorno = $this->getDenominacion() .
            "\nDireccion: " . $this->getDireccion() .
            "\nLista Bicicletas:\n";

        for ($i = 0; $i < $cantBicicletas; $i++) {
            $retorno .= $this->getBicicletas()[$i]->__toString();
        }

        $retorno .= "Ventas:\n";

        for ($i = 0; $i < $cantClientes; $i++) {
            $retorno .= $this->getClientes()[$i];
            $ventasDelCliente = $this->retornarVentasXCliente($this->getClientes()[$i]->getTipoDoc(), $this->getClientes()[$i]->getDoc());
            $cantVentasDelCliente = count($ventasDelCliente);
            for ($i = 0; $i < $cantVentasDelCliente; $i++) {
                $retorno .= $ventasDelCliente[$i];
            }
            $ventasDelCliente = null;
        }
        return $retorno;
    }

    function retornarBici($codigo)
    {
        $bicicleta = null; //Inicializamos la variable donde se almacenara la bicicleta encontrada = null
        $cantBicicletas = count($this->getBicicletas()); //Almacenamos la longitud del arreglo bicicletas
        $i = 0; //Inicializamos la variable iteradora $i = 0
        do {
            if ($this->getBicicletas()[$i]->getCodigo() == $codigo) {
                $bicicleta = $this->getBicicletas()[$i];
            } else {
                $i++;
            }
        } while ($bicicleta != null && $i < $cantBicicletas);
        return $bicicleta;
    }

    function registrarVenta($arregloCodigos, $cliente)
    {

        $cantCodigos = count($arregloCodigos);

        if (!$cliente->getBaja()) { //Si el cliente no esta dado de baja...
            $arregloBicicletas = []; //Inicializamos el arregloBicicletas = []
            $precioVenta = 0; //Inicializamos el precioVenta = 0


            for ($i = 0; $i < $cantCodigos; $i++) { //Recorriendo el arreglo de codigos iterando con $i...
                $biciEncontrada = $this->retornarBici($arregloCodigos[$i]); //Se llama a retornarBici($codigo) con cada codigo
                if (($biciEncontrada != null) && ($biciEncontrada->getActiva())) { //Si el retorno no es null (existe la bici con ese codigo) y la bici esta a la venta...
                    array_push($arregloBicicletas, $biciEncontrada); //Se agrega la bicicleta al arreglo de la venta
                    $precioVenta += $biciEncontrada->darPrecioVenta(); //Se actualiza el precio total de la venta}
                    $biciEncontrada = null; //$biciEncontrada vuelve a ser null para así buscar la próxima bici
                }
            }
            $this->setVentas($this->getVentas(), $venta = new Venta(count($this->getVentas()), '01/01/1999', $cliente, $arregloBicicletas, $precioVenta)); //Agregamos la venta al arreglo de ventas
            $retorno = $venta->getPrecioFinal();
        }
        if ($precioVenta == 0) {
            $retorno = 'Las bicicletas elegidas no estan disponibles';
        }
        return $retorno;
    }
    /*Implementar  el método retornarVentasXCliente($tipo,$numDoc) que recibe por parámetro el tipo y 
    número de documento de un Cliente y retorna una colección  con las ventas realizadas al cliente. */

    function retornarVentasXCliente($tipoDoc, $nroDoc)
    {
        $retorno = "";
        $cantClientes = count($this->getClientes());
        $cantVentas = count($this->getVentas());
        $ventas = [];

        for ($k = 0; $k < $cantVentas; $k++) {
            if ($this->getVentas()[$k]->getCliente()->getNroDoc() == $nroDoc && $this->getVentas()[$k]->getCliente()->getTipoDoc() == $tipoDoc) {
                array_push($ventas[], $this->getVentas()[$k]);
            }
        }
        return $ventas;
    }
}
