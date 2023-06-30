<?php
include_once "BaseDatos.php";
class Viaje
{
    private $id;
    private $maxPasajeros;
    private $importe;
    private $destino;
    private $empresa;
    private $responsable;
    private $pasajeros;
    private $mensajeOperacion;

    function __construct()
    {
        $this->id = 0;
        $this->maxPasajeros = 0;
        $this->importe = 0;
        $this->destino = '';
        $this->empresa = new Empresa();
        $this->responsable = new Responsable();
        $this->pasajeros = [];
    }

    public function cargar($idViaje, $maxP, $imp, $des, $empresaViaje, $responsableViaje)
    {
        $this->setId($idViaje);
        $this->setMaxPasajeros($maxP);
        $this->setImporte($imp);
        $this->setDestino($des);
        $this->setEmpresa($empresaViaje);
        $this->setResponsable($responsableViaje);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($idViaje)
    {
        $this->id = $idViaje;
    }

    public function getMaxPasajeros()
    {
        return $this->maxPasajeros;
    }

    public function setMaxPasajeros($maxP)
    {
        $this->maxPasajeros = $maxP;
    }

    public function getImporte()
    {
        return $this->importe;
    }

    public function setImporte($imp)
    {
        $this->importe = $imp;
    }

    public function getDestino()
    {
        return $this->destino;
    }

    public function setDestino($des)
    {
        $this->destino = $des;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function setEmpresa($empresaViaje)
    {
        $this->empresa = $empresaViaje;
    }

    public function getResponsable()
    {
        return $this->responsable;
    }

    public function setResponsable($responsableViaje)
    {
        $this->responsable = $responsableViaje;
    }

    public function getPasajeros()
    {
        return $this->pasajeros;
    }

    public function setPasajeros($colPasajeros)
    {
        $this->pasajeros = $colPasajeros;
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
        $arregloViaje = null;
        $base = new BaseDatos();
        $consultaViaje = "Select * from viaje ";
        if ($condicion != "") {
            $consultaViaje = $consultaViaje . ' where ' . $condicion;
        }
        $consultaViaje .= " order by idviaje ";
        //echo $consultaViaje;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaViaje)) {
                $arregloViaje = array();
                while ($row2 = $base->Registro()) {
                    $id = $row2['idviaje'];
                    $cantMaxPasajeros = $row2['vcantmaxpasajeros'];
                    $importe = $row2['vimporte'];
                    $destino = $row2['vdestino'];
                    $nEmpleado = $row2['rnumeroempleado'];
                    $idEmpresa = $row2['idempresa'];
                    $responsable = new Responsable();
                    $responsable->Buscar($nEmpleado);
                    $empresa = new Empresa();
                    $empresa->Buscar($idEmpresa);
                    $pasajero = new Pasajero();
                    $colPasajeros = $pasajero->listar("idviaje=" . $id);
                    $viaje = new Viaje();
                    $viaje->cargar($id, $cantMaxPasajeros, $importe, $destino, $empresa, $responsable);
                    $viaje->setPasajeros($colPasajeros);
                    array_push($arregloViaje, $viaje);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arregloViaje;
    }

    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consultaViaje = "Select * from viaje where idviaje=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaViaje)) {
                if ($row2 = $base->Registro()) {
                    $id = $row2['idviaje'];
                    $cantMaxPasajeros = $row2['vcantmaxpasajeros'];
                    $importe = $row2['vimporte'];
                    $destino = $row2['vdestino'];
                    $nEmpleado = $row2['rnumeroempleado'];
                    $idEmpresa = $row2['idempresa'];
                    $responsable = new Responsable();
                    $responsable->Buscar($nEmpleado);
                    $empresa = new Empresa();
                    $empresa->Buscar($idEmpresa);
                    $this->cargar($id, $cantMaxPasajeros, $importe, $destino, $empresa, $responsable);
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
        $consultaInsertar="INSERT INTO viaje(vdestino,vcantmaxpasajeros,idempresa,rnumeroempleado,vimporte) 
				VALUES ('".$this->getDestino()."','".$this->getMaxPasajeros()."',".$this->getEmpresa()->getId().",
                '".$this->getResponsable()->getNumero()."','".$this->getImporte()."')";

        if ($base->Iniciar()) {

            if ($id = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setId($id);
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
        $consultaModifica = "UPDATE viaje SET vdestino='" . $this->getDestino() . "',vcantmaxpasajeros=" . $this->getMaxPasajeros()
            . " WHERE idviaje=" . $this->getId();
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
            $consultaBorra = "DELETE FROM viaje WHERE idviaje=" . $this->getId();
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
        $listaPasajeros="";
        $pasajero=new Pasajero();
        $colPasajeros=$pasajero->listar("idviaje=".$this->getId());
        for($i=0;$i<count($colPasajeros);$i++){
            $pasajero=$colPasajeros[$i];
            $listaPasajeros.=$pasajero;
        }
        return "Viaje ID \033[96m[" . $this->getId() . "]\033[0m\n" .
            "Destino: ".$this->getDestino()."\n".
            "Máximo de pasajeros: " . $this->getMaxPasajeros() . "\n" .
            "Importe: $" . $this->getImporte() . "\n".
            "Responsable: ".$this->getResponsable().
            "Pasajeros:".$listaPasajeros."\n Empresa: ".$this->getEmpresa()->getNombre()." ID:[".$this->getEmpresa()->getId()."]\n";
    }
}
