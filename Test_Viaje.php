<?php
include 'Viaje.php'; //Importacion de la clase Viaje
include 'Pasajero.php'; //Importacion de la clase Pasajero
include 'ResponsableV.php'; //Importacion de la clase ResponsableV

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

function enUso($valor, $arreglo, $tipo)
{
    $retorno = false; //inicializamos la variable retorno en false
    $longitudArreglo = count($arreglo); //variable que almacena la longitud del arreglo ingresado
    if ($longitudArreglo > 0) { //Se ejecutaran las comprobaciones siempre y cuando el arreglo ingresado no este vacio
        $i = 0; //inicializamos la variable iteradora en cero

        switch ($tipo) {

            case 'dni':
                do {
                    if (($arreglo[$i]->getDni() == $valor)) { //Buscamos si se repite el DNI
                        $retorno = true;
                        echo "¡El numero de documento ingresado ya está en uso!\n";
                    } else { //Si no coinciden los valores, se incrementa la variable iteradora
                        $i++;
                    }
                } while (!$retorno && ($i < $longitudArreglo)); //Bucle que se repite hasta que se encuentren los datos repetidos, o por el contrario, hasta que se recorra todo el arreglo
                break;

            case 'telefono':
                do {
                    if (($arreglo[$i]->getTelefono() == $valor)) { //Buscamos si se repite el telefono
                        $retorno = true;
                        echo "¡El numero de telefono ingresado ya está en uso!\n";
                    } else { //Si no coinciden los valores, se incrementa la variable iteradora
                        $i++;
                    }
                } while (!$retorno && ($i < $longitudArreglo)); //Bucle que se repite hasta que se encuentren los datos repetidos, o por el contrario, hasta que se recorra todo el arreglo
                break;

            case 'licencia':
                do {
                    if (($arreglo[$i]->getLicencia() == $valor)) { //Buscamos si se repite el numero de licencia
                        $retorno = true;
                        echo "¡El numero de licencia ingresado ya está en uso!\n";
                    } else { //Si no coinciden los valores, se incrementa la variable iteradora
                        $i++;
                    }
                } while (!$retorno && ($i < $longitudArreglo)); //Bucle que se repite hasta que se encuentren los datos repetidos, o por el contrario, hasta que se recorra todo el arreglo
                break;
        }
    }
    return $retorno; //Retorna el valor de $retorno (si esta en uso=true, si no=false)
}

function agregarEmpleado($empleados) //Carga empleados
{
    echo "Agregar empleados...\n";

    do {
        do {
            echo "Ingrese el numero de licencia...\n"; //Se solicita el numero de empleado
            $licencia = trim(fgets(STDIN));
        } while (!esValido($licencia, true));
    } while (enUso($licencia, $empleados, 'licencia'));

    do {
        echo "Ingrese el nombre...\n"; //Se solicita el nombre
        $nombre = trim(fgets(STDIN));
    } while (!esValido($nombre, false));

    do {
        echo "Ingrese el apellido...\n"; //Se solicita el apellido
        $apellido = trim(fgets(STDIN));
    } while (!esValido($apellido, false));


    $empleado = new ResponsableV($nombre, $apellido, count($empleados), $licencia);

    return $empleado; //retorna el empleado
}

function agregarPasajero($maxPasajeros, $cantPasajeros, $viaje) //Carga pasajeros
{
    if ($cantPasajeros < $maxPasajeros) {
        echo "Agregar pasajeros...\n";
        do {
            do {
                do {
                    echo "Ingrese el numero de documento (DNI)...\n"; //Se solicita el numero de documento
                    $dni = trim(fgets(STDIN));
                } while (!esValido($dni, true));
            } while (enUso($dni, $viaje->getPasajeros(), 'dni'));

            do {
                echo "Ingrese el nombre...\n"; //Se solicita el nombre
                $nombre = trim(fgets(STDIN));
            } while (!esValido($nombre, false));

            do {
                echo "Ingrese el apellido...\n"; //Se solicita el apellido
                $apellido = trim(fgets(STDIN));
            } while (!esValido($apellido, false));

            do {
                do {
                    echo "Ingrese el numero de telefono...\n"; //Se solicita el numero de telefono
                    $tel = trim(fgets(STDIN));
                } while (!esValido($tel, true));
            } while (enUso($tel, $viaje->getPasajeros(), 'telefono'));

            $viaje->agregarPasajero(new Pasajero($nombre, $apellido, $dni, $tel)); //Se agrega el pasajero
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

function listaEmpleados($arreglo)
{ //Estructura la lista de empleados
    $retorno = "Lista de empleados:\n";
    for ($i = 0; $i < count($arreglo); $i++) {
        $retorno .= $arreglo[$i]->__toString() . "\n";
    }
    return $retorno;
}

//Variables
$cantViajes = -1; //Inicializa la cantidad de viajes en -1 por defecto
$viajes = []; //Arreglo que almacena los viajes cargados
$empleados = []; //Arreglo que almacena los empleados cargados
$salir = false;

//Programa principal
echo "
    ██╗   ██╗██╗ █████╗      ██╗███████╗    ███████╗███████╗██╗     ██╗███████╗
    ██║   ██║██║██╔══██╗     ██║██╔════╝    ██╔════╝██╔════╝██║     ██║╚══███╔╝
    ██║   ██║██║███████║     ██║█████╗      █████╗  █████╗  ██║     ██║  ███╔╝ 
    ╚██╗ ██╔╝██║██╔══██║██   ██║██╔══╝      ██╔══╝  ██╔══╝  ██║     ██║ ███╔╝  
     ╚████╔╝ ██║██║  ██║╚█████╔╝███████╗    ██║     ███████╗███████╗██║███████╗
      ╚═══╝  ╚═╝╚═╝  ╚═╝ ╚════╝ ╚══════╝    ╚═╝     ╚══════╝╚══════╝╚═╝╚══════╝\n";
do {
    //Menu de opciones
    echo "\n
[1]Cargar viaje\n
[2]Modificar viaje\n
[3]Ver viaje(s)\n
[4]Gestion de empleados\n
[5]Salir\n";
    switch (trim(fgets(STDIN))) {
        case 1:
            if(count($empleados)==0){
                do {
                    array_push($empleados, agregarEmpleado($empleados)); //Carga inicial de empleados
                    $seguir = false; //Se inicializa la variable '$seguir' en false
                    echo "¿Cargar mas empleados?(S/N)\n";
                    if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) {
                        $seguir = true; //'$seguir' sera true si el usuario desea seguir
                    }
                } while ($seguir); //Carga otro empleado en caso de que el usuario asi lo desee
            }
            echo listaEmpleados($empleados); //Muestra la lista de empleados
            do {
                echo "Ingrese el [numero] del empleado responsable...";
                $numeroEmpleado = trim(fgets(STDIN));
            } while (!esValido($numeroEmpleado, true) || ($numeroEmpleado > count($empleados)));

            do {
                echo "Ingrese el destino...\n";
                $destino = trim(fgets(STDIN));
            } while (!esValido($destino, false));

            do {
                echo "Ingrese la capacidad maxima de pasajeros...\n";
                $cantMaxPasajeros = trim(fgets(STDIN));
            } while (!esValido($cantMaxPasajeros, true));

            $cantViajes++; //Incrementa la cantidad de viajes

            $viaje = new Viaje($cantViajes, $destino, $cantMaxPasajeros, $empleados[$numeroEmpleado]); //Se crea un nuevo objeto viaje

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
                [3]Pasajeros\n
                [4]Empleado Responsable\n";

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
                        echo "
                        [1]Agregar pasajero\n
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
                            [3]DNI\n
                            [4]Telefono\n";
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
                                        } while (!esValido($dni, true) && (strlen($dni) != 7) && (enUso($dni, $viajes[$i]->getPasajeros(), $dni)));
                                        $viajes[$i]->modificarPasajero($numeroPasajero, 'dni', $dni); //Se llama a la funcion modificarPasajero
                                        break;
                                    case 4:
                                        do {
                                            echo "Ingrese el nuevo número de telefono...";
                                            $tel = trim(fgets(STDIN));
                                        } while (!esValido($tel, true) && (enUso($tel, $viajes[$i]->getPasajeros(), 'telefono')));
                                        $viajes[$i]->modificarPasajero($numeroPasajero, 'telefono', $tel); //Se llama a la funcion modificarPasajero
                                        break;
                                }
                                echo "Pasajero modificado.\n";
                        }
                        break;
                    case 4:
                        echo listaEmpleados($empleados);
                        do {
                            echo "Ingrese el [numero] del nuevo empleado responsable...";
                            $numeroEmpleado = trim(fgets(STDIN));
                        } while (!esValido($numeroEmpleado, true) || ($numeroEmpleado > count($empleados)));
                        $viajes[$i]->setResponsable($empleados[$numEmpleado]);
                        echo "El nuevo responsable es " . $empleados[$numEmpleado]->__toString();
                        break;
                }
                echo "¿Hacer mas cambios?(S/N)\n";
            } while (strncasecmp('s', trim(fgets(STDIN)), 1) == 0);
            break;

        case 3:
            echo "
            [1]Ver todos los viajes\n
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

            }
            break;
        case 4:
            echo "
            [1]Mostrar empleado(s)\n
            [2]Cargar empleado(s)\n
            [3]Modificar empleado(s)\n
            [4]Eliminar empleado(s)\n";
            switch (trim(fgets(STDIN))) {
                case 1:
                    echo listaEmpleados($empleados);
                    break;
                case 2:
                    do {
                        array_push($empleados, agregarEmpleado($empleados)); //Carga de empleados
                        $seguir = false; //Se inicializa la variable '$seguir' en false
                        echo "¿Cargar mas empleados?(S/N)\n";
                        if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) {
                            $seguir = true; //'$seguir' sera true si el usuario desea seguir
                        }
                    } while ($seguir); //Carga otro empleado en caso de que el usuario asi lo desee
                    break;
                case 3:
                    do {
                        echo listaEmpleados($empleados); //Muestra la lista de empleados
                        do {
                            echo "Ingrese el [numero] de empleado a modificar...";
                            $i = trim(fgets(STDIN));
                        } while (!esValido($i, true) || ($i > count($empleados)));
                        echo "Modificar\n
                            [1]Nombre\n
                            [2]Apellido\n
                            [3]Licencia\n";
                        switch (trim(fgets(STDIN))) {
                            case 1:
                                do {
                                    echo "Ingrese el nuevo nombre...";
                                    $nombre = trim(fgets(STDIN));
                                } while (!esValido($nombre, false));
                                $empleados[$i]->setNombre($nombre);
                                break;

                            case 2:
                                do {
                                    echo "Ingrese el nuevo apellido...";
                                    $apellido = trim(fgets(STDIN));
                                } while (!esValido($apellido, false));
                                $empleados[$i]->setApellido($apellido);
                                break;
                            case 3:
                                do {
                                    do {
                                        echo "Ingrese el nuevo numero de licencia...";
                                        $licencia = trim(fgets(STDIN));
                                    } while (!esValido($licencia, true));
                                } while (enUso($licencia, $empleados, 'licencia'));
                                $empleados[$i]->setLicencia($licencia);
                                break;
                        }
                        echo "Empleado modificado.\n";
                        echo "¿Hacer mas cambios?(S/N)\n";
                    } while (strncasecmp('s', trim(fgets(STDIN)), 1) == 0);
                    break;
                    case 4:
                        echo listaEmpleados($empleados); //Muestra la lista de empleados
                        do {
                            echo "Ingrese el [numero] del empleado a eliminar...";
                            $i = trim(fgets(STDIN));
                        } while (!esValido($i, true) && ($i > count($empleados)));
                        array_splice($empleados, ($i - 1), 1);
                        echo "Empleado eliminado.\n";
                        break;
            }
            break;

        case 5:
            $salir = true;
            break;
    }
} while (!$salir);
