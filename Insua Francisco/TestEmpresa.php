<?php
include_once 'Cliente.php';
include_once 'BicicletaNacional.php';
include_once 'BicicletaImportada.php';
include_once 'Venta.php';
include_once 'Empresa.php';
/*

Invocar al método retornarVentasXCliente($tipo,$numDoc)  donde el tipo y número de documento se corresponden con el tipo y número de documento del $objCliente1.
Invocar al método retornarVentasXCliente($tipo,$numDoc)  donde el tipo y número de documento se corresponden con  el tipo y número de documento del $objCliente2
Realizar un echo de la variable Empresa creada en 2.
 */
$objCliente1 = new Cliente('Juan', 'Perez', 34387456, 'DNI', false);
$objCliente2 = new Cliente('Michael', 'Gomez', 40234839, 'Pasaporte', false);

$obBici1 = new BicicletaNacional(11, 89500, 2022, "Fire Bird Plegable Cuadro Acero", 85, true, 11);
$obBici2 = new BicicletaNacional(12, 310000, 2021, "Bicicleta Trek Marlin 5 Rodado 29 Talle L", 70, true, 12);
$obBici3 = new BicicletaNacional(13, 10000, 2023, "Bicicleta Topmega Fixie Streeter R28 Acero 1vel Azul Osc T54", 55, false, 15);

$obBici4 = new BicicletaImportada(14, 12399900, 2020, "Bicicleta Vairo Xr 3.8 D 29", 100, true, 6244400, 'EEUU');

$empresa = new Empresa('Alta Gama', 'Av Argentina 123', [$objCliente1, $objCliente2], [$obBici1, $obBici2, $obBici3, $obBici4], []);

echo "Venta 1: " . $empresa->registrarVenta([11,12,13,14], $objCliente2) . "\n";
echo "Venta 2: " . $empresa->registrarVenta([0, 14], $objCliente2) . "\n";
echo "Venta 2: " . $empresa->registrarVenta([2, 14], $objCliente2) . "\n";
echo  "Total Ventas Importadas: $".$empresa->informarSumaVentasImportadas()."\n";
echo  "Total Ventas Nacionales: $".$empresa->informarSumaVentasNacionales()."\n";




/*Invocar al método  registrarVenta($colCodigosBicicletas, $objCliente) de la Clase Empresa donde el $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la colección de códigos de bicicletas es la siguiente [0,14].  Visualizar el resultado obtenido.
Invocar al método  registrarVenta($colCodigosBicicletas, $objCliente) de la Clase Empresa donde el $objCliente es una referencia a la clase Cliente almacenada en la variable $objCliente2 (creada en el punto 1) y la colección de códigos de bicicletas es la siguiente [2,14].  Visualizar el resultado obtenido.
Invocar al método  informarVentasImportadas().  Visualizar el resultado obtenido.
Invocar al método  informarSumaVentasNacionales().  Visualizar el resultado obtenido.
Realizar un echo de la variable Empresa creada en 3.
 */


echo $empresa;
