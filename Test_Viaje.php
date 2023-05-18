<?php
/*BUG: Al agregar un PasajeroVIP, se corrompe la lista de pasajeros :(*/

require 'Viaje.php'; //Importacion de la clase Viaje
require_once 'Pasajero.php'; //Importacion de la clase Pasajero
require_once 'PasajeroNE.php'; //Importacion de la clase PasajeroNE
require_once 'PasajeroVIP.php'; //Importacion de la clase PasajeroVIP
require 'ResponsableV.php'; //Importacion de la clase ResponsableV



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

            case 'asiento':
                do {
                    if (($arreglo[$i]->getAsiento() == $valor)) { //Buscamos si se repite el numero de asiento
                        $retorno = true;
                        echo "¡El asiento seleccionado ya esta ocupado!\n";
                    } else { //Si no coinciden los valores, se incrementa la variable iteradora
                        $i++;
                    }
                } while (!$retorno && ($i < $longitudArreglo)); //Bucle que se repite hasta que se encuentren los datos repetidos, o por el contrario, hasta que se recorra todo el arreglo
                break;

            case 'nViajeroFrecuente':
                do {
                    if (($arreglo[$i]->getNViajeroFrecuente() == $valor)) { //Buscamos si se repite el numero de viajero frecuente
                        $retorno = true;
                        echo "¡El numero de viajero frecuente ingresado ya está en uso!\n";
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
        echo "Ingrese el numero de licencia...\n"; //Se solicita el numero de empleado
        $licencia = trim(fgets(STDIN));
    } while (!esValido($licencia, true) || $licencia < 0 || (enUso($licencia, $empleados, 'licencia')));

    //Seguira iterando si el valor ingresado no es valido, o si está en uso, o si es menor que cero

    do {
        echo "Ingrese el nombre...\n"; //Se solicita el nombre
        $nombre = trim(fgets(STDIN));
    } while (!esValido($nombre, false));
    //Seguira iterando si el valor ingresado no es valido

    do {
        echo "Ingrese el apellido...\n"; //Se solicita el apellido
        $apellido = trim(fgets(STDIN));
    } while (!esValido($apellido, false));
    //Seguira iterando si el valor ingresado no es valido


    $empleado = new ResponsableV($nombre, $apellido, count($empleados), $licencia);

    return $empleado; //retorna el empleado
}

function agregarPasajero($viaje, $nTickets) //Carga pasajeros
{
    echo "Agregar pasajeros...\n";
    do {
        $esNE = false; //Se inicializa la variable que indica si tiene necesidades especiales = false
        $esVIP = false; //Se inicializa la variable que indica si es VIP = false

        echo "¿Tiene necesidades especiales?(S/N)\n";
        if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) { //Si se ingresa 'S', entonces $esNE = true
            $esNE = true;
            $silla = false; //Se inicializan las variables de las necesidades del pasajero = false
            $asistencia = false;
            $comidaEspecial = false;
        } else { //Si no tiene necesidades especiales...
            echo "¿Es VIP?(S/N)\n";
            if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) { //Si se ingresa 'S', entonces $esVIP = true
                $esVIP = true;
            }
        }

        do {
            echo "Ingrese el numero de documento (DNI)...\n"; //Se solicita el numero de documento
            $dni = trim(fgets(STDIN));
        } while (!esValido($dni, true) || (enUso($dni, $viaje->getPasajeros(), 'dni')) || $dni < 0);
        //Seguira iterando si el valor ingresado no es valido, o si está en uso, o si es menor que cero

        do {
            echo "Ingrese el nombre...\n"; //Se solicita el nombre
            $nombre = trim(fgets(STDIN));
        } while (!esValido($nombre, false));
        //Seguira iterando si el valor ingresado no es valido
        do {
            echo "Ingrese el apellido...\n"; //Se solicita el apellido
            $apellido = trim(fgets(STDIN));
        } while (!esValido($apellido, false));
        //Seguira iterando si el valor ingresado no es valido

        do {
            echo "Ingrese el numero de telefono...\n"; //Se solicita el numero de telefono
            $tel = trim(fgets(STDIN));
        } while (!esValido($tel, true) || (enUso($tel, $viaje->getPasajeros(), 'telefono')) || $tel < 0);
        //Seguira iterando si el valor ingresado no es valido, si está en uso, o es menor que cero

        do {
            echo "Ingrese el numero de asiento...\n"; //Se solicita el numero de asiento
            $asiento = trim(fgets(STDIN));
        } while (!esValido($asiento, true) || (enUso($asiento, $viaje->getPasajeros(), 'asiento')) || ($asiento > $viaje->getCantMaxPasajeros()) || ($asiento <= 0));
        //Seguira iterando si el valor ingresado no es valido, o está en uso o si es mayor a la capacidad maxima de pasajeros, o si es menor o igual a cero

        if ($esNE) { //Si el pasajero tiene necesidades especiales...
            echo "¿Requiere silla de ruedas?(S/N)\n";
            if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) { //Si se ingresa 'S', entonces $silla = true (requiere silla de ruedas)
                $silla = true;
            }
            echo "¿Requiere asistencia?(S/N)\n";
            if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) { //Si se ingresa 'S', entonces $asistencia = true (requiere asistencia)
                $asistencia = true;
            }
            echo "¿Requiere comida especial?(S/N)\n";
            if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) { //Si se ingresa 'S', entonces $comidaEspecial = true (requiere comida especial)
                $comidaEspecial = true;
            }
            if ($silla || $asistencia || $comidaEspecial) {
                $costo = $viaje->venderPasaje(new PasajeroNE($nombre, $apellido, $dni, $tel, $asiento, $nTickets, $silla, $asistencia, $comidaEspecial));
                //Si el pasajero sufre alguna de las 3 afecciones, se llama a venderPasaje() mandando como parametro atributos del pasajero NE que retorna el precio de costo y lo agrega a un arreglo de pasajeros
            }

            //Si no tiene necesidades especiales...
        } else if ($esVIP) { //Si es VIP...
            do {
                echo "Ingrese el numero de viajero frecuente...\n"; //Se solicita el numero de viajero frecuente
                $nViajeroFrecuente = trim(fgets(STDIN));
            } while (!esValido($nViajeroFrecuente, true) || (enUso($nViajeroFrecuente, $viaje->getPasajerosVIP(), 'nViajeroFrecuente')) || $nViajeroFrecuente < 0);
            //Seguira iterando si el valor ingresado no es valido, o si está en uso o si es menor a cero

            do {
                echo "Ingrese la cantidad de millas acumuladas...\n"; //Se solicita la cantidad de millas acumuladas del pasajero
                $millas = trim(fgets(STDIN));
            } while (!esValido($millas, true) || $millas < 0);
            //Seguira iterando si el valor ingresado no es valido o si es menor a cero

            $costo = $viaje->venderPasaje(new PasajeroVIP($nombre, $apellido, $dni, $tel, $asiento, $nTickets, $nViajeroFrecuente, $millas));
            //Se llama a venderPasaje(), mandando atributos del pasajero VIP que retorna el precio de costo y lo agrega a un arreglo de pasajeros y a uno de pasajeros VIP (para corroborar que el numero de viajero frecuente no este en uso)

        } else { //Si no es VIP, ni tiene necesidades especiales
            $costo = $viaje->venderPasaje(new Pasajero($nombre, $apellido, $dni, $tel, $asiento, $nTickets));
            //Se llama a venderPasaje(), mandando atributos del pasajero que retorna el precio de costo y lo agrega a un arreglo de pasajeros 

        }

        echo "El costo del viaje es: $" . $costo . "\n";
        $nTickets++; //Se incrementa el numero de Tickets

        $seguir = false; //Se inicializa la variable '$seguir' en false
        if ($viaje->hayPasajesDisponibles()) { //En caso de que haya lugar para mas pasajeros, le pregunta al usuario
            echo "¿Cargar mas pasajeros?(S/N)\n";
            if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) {
                $seguir = true; //'$seguir' sera true si el usuario desea seguir
            }
        }
    } while ($seguir); //Carga otro pasajero en caso de que el usuario asi lo desee

    return $nTickets;
}

function listaEmpleados($arreglo)
{ //Estructura la lista de empleados
    $retorno = "Lista de empleados:\n";
    for ($i = 0; $i < count($arreglo); $i++) {
        $retorno .= $arreglo[$i] . "\n";
    }
    return $retorno;
}

//Variables
$cantViajes = 0; //Inicializa la cantidad de viajes en 0 por defecto
$viajes = []; //Arreglo que almacena los viajes cargados
$empleados = []; //Arreglo que almacena los empleados cargados
$salir = false;
$nTickets = 0; //Inicializa la cantidad de tickets en 0 por defecto



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
            if (count($empleados) == 0) {
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
            } while (!esValido($numeroEmpleado, true) || ($numeroEmpleado >= count($empleados)) || $numeroEmpleado < 0);
            //Seguira iterando si el valor ingresado no es valido, o si es mayor o igual a la cantidad de empleados (porque el primer indice es 0), o si es menor a 0

            do {
                echo "Ingrese el destino...\n";
                $destino = trim(fgets(STDIN));
            } while (!esValido($destino, false));
            //Seguira iterando si el valor ingresado no es valido

            do {
                echo "Ingrese la distancia (en millas)...\n";
                $millas = trim(fgets(STDIN));
            } while (!esValido($millas, true) || ($millas <= 0));
            //Seguira iterando si el valor ingresado no es valido, o si es menor o igual que 0

            do {
                echo "Ingrese la capacidad maxima de pasajeros...\n";
                $cantMaxPasajeros = trim(fgets(STDIN));
            } while (!esValido($cantMaxPasajeros, true) || ($cantMaxPasajeros <= 0));
            //Seguira iterando si el valor ingresado no es valido, o si es menor o igual que 0

            do {
                echo "Ingrese el costo del viaje...\n";
                $costo = trim(fgets(STDIN));
            } while (!esValido($costo, true) || ($costo <= 0));
            //Seguira iterando si el valor ingresado no es valido, o si es menor o igual que 0 (porque nada es gratis en esta vida)

            $viaje = new Viaje($cantViajes, $destino, $cantMaxPasajeros, [], [], $empleados[$numeroEmpleado], $costo, 0, [], $millas);
            //Se crea un nuevo objeto viaje
            $cantViajes++; //Incrementa la cantidad de viajes (codigo)

            $nTickets = agregarPasajero($viaje, $nTickets);
            //Se llama a la funcion agregarPasajero que retorna el numero de ticket (se incrementa en uno por cada pasaje vendido)

            array_push($viajes, $viaje); //Se agrega el viaje cargado al arreglo de viajes cargados

            echo "Viaje codigo " . $viaje->getCodigo() . " cargado\n";

            break;

        case 2:
            do {
                echo "Ingrese el codigo del viaje...";
                $i = trim(fgets(STDIN));
            } while (!esValido($i, true) || $i > $cantViajes || $i < 0);
            //Seguira iterando si el valor ingresado no es valido, o si es mayor a la cantidad de viajes, o menor que cero


            echo $viajes[$i] . "\n"; //Se muestran los datos del viaje por pantalla
            do {
                echo "¿Que desea modificar?\n
                [1]Destino\n
                [2]Capacidad maxima de pasajeros\n
                [3]Pasajeros\n
                [4]Empleado Responsable\n
                [5]Costo\n
                [6]Distancia (en millas)\n";

                switch (trim(fgets(STDIN))) {
                    case 1:
                        do {
                            echo "Ingrese el nuevo destino...\n";
                            $destino = trim(fgets(STDIN));
                        } while (!esValido($destino, false));
                        $viajes[$i]->setDestino($destino);
                        break;
                    case 2:
                        do {
                            echo "Ingrese la nueva capacidad maxima de pasajeros...\n";
                            $cantMaxPasajeros = trim(fgets(STDIN));
                        } while (!esValido($cantMaxPasajeros, true));
                        $viajes[$i]->setCantMaxPasajeros($cantMaxPasajeros);
                        break;
                    case 3:
                        echo "
                        [1]Agregar pasajero\n
                        [2]Eliminar pasajero\n
                        [3]Modificar pasajero\n";

                        switch (trim(fgets(STDIN))) {
                            case 1:
                                if ($viajes[$i]->hayPasajesDisponibles()) {
                                    agregarPasajero($viajes[$i], $nTickets);
                                } //Se llama a la funcion agregarPasajero
                                else {
                                    echo "No hay pasajes disponibles.";
                                }
                                break;
                            case 2:
                                echo $viajes[$i]->mostrarPasajeros(); //Muestra la lista de pasajeros
                                do {
                                    echo "Ingrese el [numero] del pasajero a eliminar...";
                                    $numeroPasajero = trim(fgets(STDIN));
                                } while (!esValido($numeroPasajero, true) || ($numeroPasajero >= count($viajes[$i]->getPasajeros())));
                                //Seguira iterando si el valor ingresado no es valido, o si es mayor o igual a la cantidad total de pasajeros (porque el primer pasajero es de indice 0)

                                $viajes[$i]->eliminarPasajero($numeroPasajero); //Se llama a la funcion eliminarPasajero
                                echo "Pasajero eliminado.\n";
                                break;
                            case 3:
                                echo $viajes[$i]->mostrarPasajeros(); //Muestra la lista de pasajeros
                                do {
                                    echo "Ingrese el [numero] del pasajero a modificar...";
                                    $numeroPasajero = trim(fgets(STDIN));
                                } while (!esValido($numeroPasajero, true) || ($numeroPasajero >= count($viajes[$i]->getPasajeros())));
                                //Seguira iterando si el valor ingresado no es valido, o si es mayor o igual a la cantidad total de pasajeros (porque el primer pasajero es de indice 0)
                                echo "Modificar\n
                            [1]Nombre\n
                            [2]Apellido\n
                            [3]DNI\n
                            [4]Telefono\n
                            [5]Asiento";
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
                                        } while (!esValido($dni, true) || (enUso($dni, $viajes[$i]->getPasajeros(), $dni)));
                                        //Seguira iterando si el valor ingresado no es valido, o si esta en uso

                                        $viajes[$i]->modificarPasajero($numeroPasajero, 'dni', $dni); //Se llama a la funcion modificarPasajero
                                        break;
                                    case 4:
                                        do {
                                            echo "Ingrese el nuevo número de telefono...";
                                            $tel = trim(fgets(STDIN));
                                        } while (!esValido($tel, true) || (enUso($tel, $viajes[$i]->getPasajeros(), 'telefono')));
                                        //Seguira iterando si el valor ingresado no es valido, o si esta en uso

                                        $viajes[$i]->modificarPasajero($numeroPasajero, 'telefono', $tel); //Se llama a la funcion modificarPasajero
                                        break;
                                    case 5:
                                        do {
                                            echo "Ingrese el nuevo número de asiento...";
                                            $asiento = trim(fgets(STDIN));
                                        } while (!esValido($asiento, true) || (enUso($asiento, $viajes[$i]->getPasajeros(), 'asiento')));
                                        //Seguira iterando si el valor ingresado no es valido, o si esta en uso

                                        $viajes[$i]->modificarPasajero($numeroPasajero, 'asiento', $tel); //Se llama a la funcion modificarPasajero
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
                        echo "El nuevo responsable es " . $empleados[$numEmpleado];
                        break;
                    case 5:
                        do {
                            echo "Ingrese el nuevo precio de costo...\n";
                            $costo = trim(fgets(STDIN));
                        } while (!esValido($costo, true));
                        $viajes[$i]->setCosto($costo);
                        break;
                    case 6:
                        do {
                            echo "Ingrese la nueva distancia (en millas)...\n";
                            $millas = trim(fgets(STDIN));
                        } while (!esValido($millas, true));
                        $viajes[$i]->setMillas($millas);
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
                        echo $viajes[$i] . "\n";
                    }
                    break;
                case 2:
                    do {
                        echo "Ingrese el codigo del viaje...";
                        $i = trim(fgets(STDIN));
                    } while (!esValido($i, true) || $i > $cantViajes || $i < 0);
                    //Seguira iterando si el valor ingresado no es valido, o si es mayor a la cantidad de viajes, o menor que cero
                    echo $viajes[$i] . "\n"; //Se muestran los datos del viaje por pantalla

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
                    } while (!esValido($i, true) || ($i >= count($empleados)) || $i < 0);
                    //Seguira iterando si el valor ingresado no es valido, o si es mayor o igual a la cantidad de empleados (porque el primer indice es 0), o si es menor que cero
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
