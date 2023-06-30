<?php
include_once "BaseDatos.php";
include_once "Viaje.php";
class Pasajero
{
	private $dni;
	private $telefono;
	private $nombre;
	private $apellido;
	private $mensajeOperacion;
	private $viaje;

	public function __construct()
	{
		$this->dni = 0;
		$this->telefono = '';
		$this->nombre = '';
		$this->apellido = '';
		$this->viaje = new Viaje;
	}

	public function cargar($dniPasajero, $nombrePasajero, $apellidoPasajero, $tel, $objViaje)
	{
		$this->setDni($dniPasajero);
		$this->setNombre($nombrePasajero);
		$this->setApellido($apellidoPasajero);
		$this->setTelefono($tel);
		$this->setViaje($objViaje);
	}

	public function getDni()
	{
		return $this->dni;
	}

	public function setDni($nDoc)
	{
		$this->dni = $nDoc;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	public function setNombre($nombrePasajero)
	{
		$this->nombre = $nombrePasajero;
	}

	public function getApellido()
	{
		return $this->apellido;
	}

	public function setApellido($apellidoPasajero)
	{
		$this->apellido = $apellidoPasajero;
	}

	public function getTelefono()
	{
		return $this->telefono;
	}

	public function setTelefono($tel)
	{
		$this->telefono = $tel;
	}

	public function getViaje()
	{
		return $this->viaje;
	}

	public function setViaje($objViaje)
	{
		$this->viaje = $objViaje;
	}

	public function getMensajeOperacion()
	{
		return $this->mensajeOperacion;
	}

	public function setMensajeOperacion($mensajeOp)
	{
		$this->mensajeOperacion = $mensajeOp;
	}

	public function listar($condicion = "")
	{
		$arregloPasajero = null;
		$base = new BaseDatos();
		$consultaPasajero = "Select * from pasajero ";
		if ($condicion != "") {
			$consultaPasajero = $consultaPasajero . ' where ' . $condicion;
		}
		$consultaPasajero .= " order by papellido ";
		//echo $consultaPasajero;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaPasajero)) {
				$arregloPasajero = array();
				while ($row2 = $base->Registro()) {
					$viaje = new Viaje;
					$viaje->Buscar($row2['idviaje']);
					$nroDoc = $row2['pdocumento'];
					$nombre = $row2['pnombre'];
					$apellido = $row2['papellido'];
					$telefono = $row2['ptelefono'];
					$pasajero = new Pasajero();
					$pasajero->cargar($nroDoc, $nombre, $apellido, $telefono, $viaje);
					array_push($arregloPasajero, $pasajero);
				}
			} else {
				$this->setMensajeOperacion($base->getError());
			}
		} else {
			$this->setMensajeOperacion($base->getError());
		}
		return $arregloPasajero;
	}

	public function Buscar($dni)
	{
		$base = new BaseDatos();
		$consultaPasajero = "Select * from pasajero where pdocumento=" . $dni;
		$resp = false;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaPasajero)) {
				if ($row2 = $base->Registro()) {
					$viaje = new Viaje;
					$viaje->Buscar($row2['idviaje']);
					$nombre = $row2['pnombre'];
					$apellido = $row2['papellido'];
					$telefono = $row2['ptelefono'];
					$this->cargar($dni, $nombre, $apellido, $telefono, $viaje);
					$resp = true;
				}
			} else {
				$this->setMensajeOperacion($base->getError());
			}
		} else {
			$this->setMensajeOperacion($base->getError());
		}
		return $resp;
	}

	public function insertar()
	{
		$base = new BaseDatos();
		$resp = false;
		$consultaInsertar = "INSERT INTO pasajero(pdocumento, pnombre, papellido,  ptelefono,idviaje) 
				VALUES ('" . $this->getDni() . "','" . $this->getNombre() . "','" . $this->getApellido() . "'," . $this->getTelefono() . "," . $this->getViaje()->getId() . ")";

		if ($base->Iniciar()) {

			if ($dni = $base->devuelveIDInsercion($consultaInsertar)) {
				$this->setDni($dni);
				$resp =  true;
			} else {
				$this->setMensajeOperacion($base->getError());
			}
		} else {
			$this->setMensajeOperacion($base->getError());
		}
		return $resp;
	}



	public function modificar()
	{
		$resp = false;
		$base = new BaseDatos();
		$consultaModifica = "UPDATE pasajero SET papellido='" . $this->getApellido() . "',pnombre='" . $this->getNombre() . "'
                           ,ptelefono='" . $this->getTelefono() . "' WHERE pdocumento='" . $this->getDni() . "'";
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaModifica)) {
				$resp =  true;
			} else {
				$this->setMensajeOperacion($base->getError());
			}
		} else {
			$this->setMensajeOperacion($base->getError());
		}
		return $resp;
	}

	public function eliminar()
	{
		$base = new BaseDatos();
		$resp = false;
		if ($base->Iniciar()) {
			$consultaBorra = "DELETE FROM pasajero WHERE pdocumento='" . $this->getDni() . "'";
			if ($base->Ejecutar($consultaBorra)) {
				$resp =  true;
			} else {
				$this->setMensajeOperacion($base->getError());
			}
		} else {
			$this->setMensajeOperacion($base->getError());
		}
		return $resp;
	}

	public function __toString()
	{
		return "Pasajero " . $this->getNombre() . " " . $this->getApellido() .
			"\nDNI: " . $this->getDni() .
			"\nTeléfono: " . $this->getTelefono() . "\nViaja con " . $this->getViaje()->getEmpresa()->getNombre() . " ID:[" . $this->getViaje()->getEmpresa()->getId() . "]";
	}
}
