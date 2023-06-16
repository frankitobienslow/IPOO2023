<?php
/*El test del recuperatorio fue hecho sobre el test del segundo parcial
PD:No entre a discord, por lo tanto no corregi el segundo parcial en casa.. lo hice en los ultimos minutos del recuperatorio (podria estar mejor)*/

include_once 'Cliente.php';
include_once 'BicicletaNacional.php';
include_once 'BicicletaImportada.php';
include_once 'Venta.php';
include_once 'Empresa.php';

$objCliente1 = new Cliente('Juan', 'Perez', 34387456, 'DNI', false);
$objCliente2 = new Cliente('Michael', 'Gomez', 40234839, 'Pasaporte', false);

$obBici1 = new BicicletaNacional(11, 89500, 2022, "Fire Bird Plegable Cuadro Acero", 85, true, 11);
$obBici2 = new BicicletaNacional(12, 310000, 2021, "Bicicleta Trek Marlin 5 Rodado 29 Talle L", 70, true, 12);
$obBici3 = new BicicletaNacional(13, 10000, 2023, "Bicicleta Topmega Fixie Streeter R28 Acero 1vel Azul Osc T54", 55, false, 15);

$obBici4 = new BicicletaImportada(14, 12399900, 2020, "Bicicleta Vairo Xr 3.8 D 29", 100, true, 6244400, 'EEUU');

$empresa = new Empresa('Alta Gama', 'Av Argentina 123', [$objCliente1, $objCliente2], [$obBici1, $obBici2, $obBici3, $obBici4], []);

echo "Venta 1: " . $empresa->registrarVenta([11,12,13,14], $objCliente2,"on-line",["fecha"=>"10/06/2023","forma de pago"=>"efectivo","direccion de entrega"=>'Roca 876',"telefono de contacto"=>2997653908,"dni recepcionista"=>23784569]) . "\n";
echo "Venta 2: " . $empresa->registrarVenta([0, 14], $objCliente2,"local",["fecha"=>"9/07/2023","forma de pago"=>"credito","dia de retiro"=>'martes 13',"hora de retiro"=>"19:00"]) . "\n";
echo "Venta 2: " . $empresa->registrarVenta([2, 14], $objCliente2,"local",["fecha"=>"12/02/2023","forma de pago"=>"mercadopago","dia de retiro"=>'viernes 13',"hora de retiro"=>"14:30"]) . "\n";
/*echo  "Total Ventas Importadas: $".$empresa->informarSumaVentasImportadas()."\n";
echo  "Total Ventas Nacionales: $".$empresa->informarSumaVentasNacionales()."\n";*/
echo $empresa->retornarVentasOnline();
echo $empresa->retornarImporteVentasEnLocal();
echo $empresa;
