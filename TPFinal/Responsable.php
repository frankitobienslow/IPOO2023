<?php
include_once "BaseDatos.php";
class Responsable
{
    private $licencia;
    private $numero;
    private $nombre;
    private $apellido;
    private $mensajeOperacion;

    function __construct()
    {
        $this->licencia = 0;
        $this->nombre = '';
        $this->apellido = '';
        $this->numero = 0;
    }

    public function cargar($nResponsable, $nLicencia, $nombreResponsable, $apellidoResponsable)
    {
        $this->setNumero($nResponsable);
        $this->setLicencia($nLicencia);
        $this->setNombre($nombreResponsable);
        $this->setApellido($apellidoResponsable);
    }

    public function getLicencia()
    {
        return $this->licencia;
    }

    public function setLicencia($nLicencia)
    {
        $this->licencia = $nLicencia;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombreResponsable)
    {
        $this->nombre = $nombreResponsable;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellidoResponsable)
    {
        $this->apellido = $apellidoResponsable;
    }


    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($nEmpleado)
    {
        $this->numero = $nEmpleado;
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
        $arregloResponsable = null;
        $base = new BaseDatos();
        $consultaResponsable = "Select * from responsable ";
        if ($condicion != "") {
            $consultaResponsable = $consultaResponsable . ' where ' . $condicion;
        }
        $consultaResponsable .= " order by rnumeroempleado ";
        //echo $consultaResponsable;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaResponsable)) {
                $arregloResponsable = array();
                while ($row2 = $base->Registro()) {
                    $numero = $row2['rnumeroempleado'];
                    $nombre = $row2['rnombre'];
                    $apellido = $row2['rapellido'];
                    $licencia = $row2['rnumerolicencia'];
                    $responsable = new responsable();
                    $responsable->cargar($numero, $licencia, $nombre, $apellido);
                    array_push($arregloResponsable, $responsable);
                }
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $arregloResponsable;
    }

    public function Buscar($numeroEmpleado)
    {
        $base = new BaseDatos();
        $consultaResponsable = "Select * from responsable where rnumeroempleado=" . $numeroEmpleado;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaResponsable)) {
                if ($row2 = $base->Registro()) {
                    $nombre = $row2['rnombre'];
                    $apellido = $row2['rapellido'];
                    $licencia = $row2['rnumerolicencia'];
                    $this->cargar($numeroEmpleado, $licencia, $nombre, $apellido);
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
        $consultaInsertar = "INSERT INTO responsable(rnumerolicencia, rnombre, rapellido) 
				VALUES (" . $this->getLicencia() . ",'" . $this->getNombre() . "','" . $this->getApellido() . "')";

        if ($base->Iniciar()) {

            if ($numero = $base->devuelveIDInsercion($consultaInsertar)) {
                $this->setNumero($numero);
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
        $consultaModifica = "UPDATE responsable SET rapellido='" . $this->getApellido() . "',rnombre='" . $this->getNombre() . "'
                           ,rnumerolicencia=" . $this->getLicencia() . " WHERE rnumeroempleado=" . $this->getNumero();
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
            $consultaBorra = "DELETE FROM responsable WHERE rnumeroempleado=" . $this->getNumero();
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
        return "Responsable N\033[96m[" . $this->getNumero() . "]\033[0m " . $this->getNombre() . " " . $this->getApellido() . "\n" .
            "Licencia N°" . $this->getLicencia();
    }
}
