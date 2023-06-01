<?php
include_once 'Cliente.php';
include_once 'Bicicleta.php';
include_once 'Venta.php';
include_once 'Empresa.php';
/*

Invocar al método retornarVentasXCliente($tipo,$numDoc)  donde el tipo y número de documento se corresponden con el tipo y número de documento del $objCliente1.
Invocar al método retornarVentasXCliente($tipo,$numDoc)  donde el tipo y número de documento se corresponden con  el tipo y número de documento del $objCliente2
Realizar un echo de la variable Empresa creada en 2.
 */
$objCliente1=new Cliente('Juan','Perez',34387456,'DNI',false);
$objCliente2=new Cliente('Michael','Gomez',40234839,'Pasaporte',false);

$obBici1=new Bicicleta(11,89500,2022,'Fire Bird Plegable Cuadro Acero',85,true);
$obBici2=new Bicicleta(12,310000,2021,'Bicicleta Trek Marlin 5 Rodado 29 Talle L',70,true);
$obBici3=new Bicicleta(13,10000,2023,'Bicicleta Topmega Fixie Streeter R28 Acero 1vel Azul Osc T54',55,false);

$empresa=new Empresa('Alta Gama','Av Argentina 123',[$objCliente1,$objCliente2],[$obBici1,$obBici2,$obBici3],[]);

echo $empresa->registrarVenta([11,12,13],$objCliente2,'01/05/2023');
echo $empresa->registrarVenta([0],$objCliente2,'01/05/2023');
echo $empresa->registrarVenta([2],$objCliente2,'01/05/2023');
echo  $empresa->retornarVentasXCliente('DNI',34387456);
echo  $empresa->retornarVentasXCliente('Pasaporte',40234839);

echo $empresa;
