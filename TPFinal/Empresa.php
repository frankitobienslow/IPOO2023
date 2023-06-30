<?php
include_once "BaseDatos.php";
class Empresa
{
    private $id;
    private $nombre;
    private $direccion;
    private $coleccionViajes;
    private $mensajeOperacion;

    function __construct()
    {
        $this->id = 0;
        $this->nombre = '';
        $this->direccion = '';
        $this->coleccionViajes = [];
    }

    public function cargar($idEmpresa, $nombreEmpresa, $direccionEmpresa)
    {
        $this->setId($idEmpresa);
        $this->setNombre($nombreEmpresa);
        $this->setDireccion($direccionEmpresa);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($idEmpresa)
    {
        $this->id = $idEmpresa;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombreEmpresa)
    {
        $this->nombre = $nombreEmpresa;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($dir)
    {
        $this->direccion = $dir;
    }

    public function getViajes()
    {
        return $this->coleccionViajes;
    }

    public function setViajes($colViajes)
    {
        $this->coleccionViajes = $colViajes;
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
        $arregloEmpresa = null;
        $base = new BaseDatos();
        $consultaEmpresa = "Select * from empresa ";
        if ($condicion != "") {
            $consultaEmpresa = $consultaEmpresa . ' where ' . $condicion;
        }
        $consultaEmpresa .= " order by idempresa ";
        //echo $consultaEmpresa;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaEmpresa)) {
                $arregloEmpresa = array();
                while ($row2 = $base->Registro()) {
                    $id = $row2['idempresa'];
                    $nombre = $row2['enombre'];
                    $direccion = $row2['edireccion'];
                    $viaje = new Viaje();
                    $colViajes = $viaje->listar("idempresa=" . $id);
                    $empresa = new Empresa();
                    $empresa->setViajes($colViajes);
                    $empresa->cargar($id, $nombre, $direccion);
                    array_push($arregloEmpresa, $empresa);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arregloEmpresa;
    }

    public function Buscar($id)
    {
        $base = new BaseDatos();
        $consultaEmpresa = "Select * from empresa where idempresa=" . $id;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaEmpresa)) {
                if ($row2 = $base->Registro()) {
                    $nombre = $row2['enombre'];
                    $direccion = $row2['edireccion'];
                    $this->cargar($id, $nombre, $direccion);
                    $resp = true;
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }


    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $consultaInsertar = "INSERT INTO empresa(enombre, edireccion) 
				VALUES ('" . $this->getNombre() . "','" . $this->getDireccion() . "')";

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
        $consultaModifica="UPDATE empresa SET enombre='".$this->getNombre()."'
                           ,edireccion='".$this->getDireccion()."' WHERE idempresa=". $this->getId();
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
            $consultaBorra = "DELETE FROM empresa WHERE idempresa=" . $this->getId();
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
        return "Empresa ID:\033[96m[" . $this->getId() . "]\033[0m " . $this->getNombre() . " \n" .
            "Direccion: " . $this->getDireccion();
    }
}
