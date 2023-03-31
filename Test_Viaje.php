<?php
include 'Viaje.php'; //Importacion de la clase Viaje
//Funciones
function esValido($valor, $esNumerico) //Funcion que retorna si el valor ingresado es valido
{
    $retorno = false; //inicializamos la variable retorno en false
    if (is_numeric($valor) && $esNumerico) { //Si el valor solicitado debe ser un numero y el valor ingresado es un numero
        $retorno = true; //retorna true
    } else if (!is_numeric($valor) && !$esNumerico) { //Si el valor solicitado no debe ser un numero y el valor ingresado no es un numero
        $retorno = true; //retorna true
    } else {
        echo "El valor ingresado no es valido.\n"; //Si no, retorna false
    }
    return $retorno;
}

function agregarPasajero($maxPasajeros, $cantPasajeros, $viaje) //Carga pasajeros
{
    if ($cantPasajeros < $maxPasajeros) {
        echo "Agregar pasajeros...\n";
        do {
            do {
                echo "Ingrese el numero de documento (DNI)...\n"; //Se solicita el numero de documento
                $dni = trim(fgets(STDIN));
            } while (!esValido($dni, true) && (strlen($dni) != 7));

            do {
                echo "Ingrese el nombre...\n"; //Se solicita el nombre
                $nombre = trim(fgets(STDIN));
            } while (!esValido($nombre, false));

            do {
                echo "Ingrese el apellido...\n"; //Se solicita el apellido
                $apellido = trim(fgets(STDIN));
            } while (!esValido($apellido, false));

            $viaje->agregarPasajero($nombre, $apellido, $dni); //Se agrega el pasajero
            $cantPasajeros++; //Se incrementa la cantidad de pasajeros

            $seguir = false; //Se inicializa la variable '$seguir' en false
            if ($cantPasajeros < $maxPasajeros) { //En caso de que haya lugar para mas pasajeros, le pregunta al usuario
                echo "¿Cargar mas pasajeros?(S/N)\n";
                if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) {
                    $seguir = true; //'$seguir' sera true si el usuario desea seguir
                }
            }
        } while ($seguir); //Carga otro pasajero en caso de que el usuario asi lo desee
    } else {
        echo "¡Se alcanzó el limite de pasajeros!\n";
    }
}

//Variables
$cantViajes = -1; //Inicializa la cantidad de viajes en -1 por defecto
$viajes = []; //Arreglo que almacena los viajes cargados
$salir = false;

//Programa principal
echo "
    ██╗   ██╗██╗ █████╗      ██╗███████╗    ███████╗███████╗██╗     ██╗███████╗
    ██║   ██║██║██╔══██╗     ██║██╔════╝    ██╔════╝██╔════╝██║     ██║╚══███╔╝
    ██║   ██║██║███████║     ██║█████╗      █████╗  █████╗  ██║     ██║  ███╔╝ 
    ╚██╗ ██╔╝██║██╔══██║██   ██║██╔══╝      ██╔══╝  ██╔══╝  ██║     ██║ ███╔╝  
     ╚████╔╝ ██║██║  ██║╚█████╔╝███████╗    ██║     ███████╗███████╗██║███████╗
      ╚═══╝  ╚═╝╚═╝  ╚═╝ ╚════╝ ╚══════╝    ╚═╝     ╚══════╝╚══════╝╚═╝╚══════╝\n";

do { //Menu de opciones
    echo "\n[1]Cargar viaje\n
[2]Modificar viaje\n
[3]Ver viaje(s)\n
[4]Salir\n";
    switch (trim(fgets(STDIN))) {
        case 1:
            do {
                echo "Ingrese el destino...\n";
                $destino = trim(fgets(STDIN));
            } while (!esValido($destino, false));

            do {
                echo "Ingrese la capacidad maxima de pasajeros...\n";
                $cantMaxPasajeros = trim(fgets(STDIN));
            } while (!esValido($cantMaxPasajeros, true));

            $cantViajes++; //Incrementa la cantidad de viajes

            $viaje = new Viaje($cantViajes, $destino, $cantMaxPasajeros); //Se crea un nuevo objeto viaje

            agregarPasajero($cantMaxPasajeros, 0, $viaje); //Se llama a la funcion agregarPasajero

            array_push($viajes, $viaje); //Se agrega el viaje cargado al arreglo de viajes cargados
            echo "Viaje codigo " . $viaje->getCodigo() . " cargado\n";
            break;

        case 2:
            do {
                echo "Ingrese el codigo del viaje...";
                $i = trim(fgets(STDIN));
            } while (!esValido($i, true) && $i > $cantViajes);

            echo $viajes[$i]->__toString() . "\n"; //Se muestran los datos del viaje por pantalla
            do {
                echo "¿Que desea modificar?\n
                [1]Destino\n
                [2]Capacidad maxima de pasajeros\n
                [3]Pasajeros\n";

                switch (trim(fgets(STDIN))) {
                    case 1:
                        echo "Ingrese el nuevo destino...\n";
                        $viajes[$i]->setDestino(trim(fgets(STDIN)));
                        break;
                    case 2:
                        echo "Ingrese la nueva capacidad maxima de pasajeros...\n";
                        $viajes[$i]->setCantMaxPasajeros(trim(fgets(STDIN)));
                        break;
                    case 3:
                        echo "[1]Agregar pasajero\n
                        [2]Eliminar pasajero\n
                        [3]Modificar pasajero\n";

                        switch (trim(fgets(STDIN))) {
                            case 1:
                                agregarPasajero($viajes[$i]->getCantMaxPasajeros(), count($viajes[$i]->getPasajeros()), $viajes[$i]); //Se llama a la funcion agregarPasajero
                                break;
                            case 2:
                                echo $viajes[$i]->mostrarPasajeros(); //Muestra la lista de pasajeros
                                do {
                                    echo "Ingrese el [numero] del pasajero a eliminar...";
                                    $numeroPasajero = trim(fgets(STDIN));
                                } while (!esValido($numeroPasajero, true) && ($numeroPasajero > count($viajes[$i]->getPasajeros())));
                                $viajes[$i]->eliminarPasajero($numeroPasajero); //Se llama a la funcion eliminarPasajero
                                echo "Pasajero eliminado.\n";
                                break;
                            case 3:
                                echo $viajes[$i]->mostrarPasajeros(); //Muestra la lista de pasajeros
                                do {
                                    echo "Ingrese el [numero] del pasajero a modificar...";
                                    $numeroPasajero = trim(fgets(STDIN));
                                } while (!esValido($numeroPasajero, true) && ($numeroPasajero > count($viajes[$i]->getPasajeros())));
                                echo "Modificar\n
                            [1]Nombre\n
                            [2]Apellido\n
                            [3]DNI\n";
                                switch (trim(fgets(STDIN))) {
                                    case 1:
                                        do {
                                            echo "Ingrese el nuevo nombre...";
                                            $nombre = trim(fgets(STDIN));
                                        } while (!esValido($nombre, false));
                                        $viajes[$i]->modificarPasajero($numeroPasajero, 'nombre', $nombre);
                                        break;

                                    case 2:
                                        do {
                                            echo "Ingrese el nuevo apellido...";
                                            $apellido = trim(fgets(STDIN));
                                        } while (!esValido($apellido, false));
                                        $viajes[$i]->modificarPasajero($numeroPasajero, 'apellido', $apellido);
                                        break;
                                    case 3:
                                        do {
                                            echo "Ingrese el nuevo DNI...";
                                            $dni = trim(fgets(STDIN));
                                        } while (!esValido($dni, true)&& (strlen($dni) != 7));
                                        $viajes[$i]->modificarPasajero($numeroPasajero, 'dni', $dni); //Se llama a la funcion modificarPasajero
                                        break;
                                }
                                echo "Pasajero modificado.\n";
                        }
                }
                echo "¿Hacer mas cambios?(S/N)\n";
            } while (strncasecmp('s', trim(fgets(STDIN)), 1) == 0);
            break;

        case 3:
            echo "[1]Ver todos los viajes\n
            [2]Ver un viaje en especifico\n";
            switch (trim(fgets(STDIN))) {
                case 1:
                    for ($i = 0; $i < count($viajes); $i++) {
                        echo $viajes[$i]->__toString() . "\n";
                    }
                    break;
                case 2:
                    do {
                        echo "Ingrese el codigo del viaje...";
                        $i = trim(fgets(STDIN));
                    } while (!esValido($i, true) && $i > $cantViajes);
                    echo $viajes[$i]->__toString() . "\n"; //Se muestran los datos del viaje por pantalla
                    break;
            }

        case 4:
            $salir = true;
    }
} while (!$salir);
