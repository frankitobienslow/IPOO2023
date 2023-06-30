<?php
/*AVISO PODRIA ESTAR MEJOR, TIENE ALGUNOS BUGS */
include_once 'Viaje.php';
include_once 'Empresa.php';
include_once 'Responsable.php';
include_once 'Pasajero.php';

$salir = false;
do {
    echo
    "\033[32m>>GESTIONAR\033[0m
\033[93m[1]\033[0mEMPRESAS
\033[93m[2]\033[0mRESPONSABLES
\033[93m[3]\033[0mVIAJES
\033[93m[4]\033[0mPASAJEROS
\033[93m[5]\033[0m\033[31mSALIR \033[0m\n";

    switch (trim(fgets(STDIN))) {
        case 1: //MENU EMPRESA
            echo
            "\033[93m[1]\033[0mIngresar empresa...
        \033[93m[2]\033[0mModificar empresa...
        \033[93m[3]\033[0mEliminar empresa...
        \033[93m[4]\033[0mListar empresas...
        \033[93m[5]\033[0m\033[31mSALIR \033[0m\n";

            switch (trim(fgets(STDIN))) {

                case 1: //OPCION CARGAR EMPRESA
                    //Se solicitan los datos de la empresa al usuario
                    echo "Nombre:";
                    do {
                        $nombre = trim(fgets(STDIN));
                    } while (!esValido($nombre, false));

                    echo "Direccion:";
                    do {
                        $direccion = trim(fgets(STDIN));
                    } while (!esValido($direccion, false));

                    $empresa = new Empresa(); //Se crea una nueva instancia de empresa
                    $empresa->cargar(null, $nombre, $direccion); //Se le cargan los datos ingresados por el usuario
                    $exito = $empresa->insertar(); //$exito sera true si la operación tuvo éxito, de lo contrario sera false
                    if ($exito) {
                        echo "Empresa agregada.";
                    } else {
                        echo "ERROR: " . $empresa->getMensajeOperacion(); //De lo contrario, imprime por pantalla el error
                    }
                    break;

                case 2: //OPCION MODIFICAR EMPRESA
                    $empresa = new Empresa;
                    $arregloEmpresas = $empresa->listar();
                    mostrar($arregloEmpresas);
                    //Se solicita el id de la empresa a modificar
                    echo "Ingrese el ID de la empresa a modificar...";
                    do {
                        $idEmpresa = trim(fgets(STDIN));
                    } while (!esValido($idEmpresa, true));

                    $exito = $empresa->Buscar($idEmpresa);

                    if ($exito) {
                        do {
                            $seguir = false;
                            echo "[1]Modificar nombre
                    [2]Modificar direccion";

                            switch (trim(fgets(STDIN))) {
                                case 1:
                                    echo "Nuevo nombre:";
                                    do {
                                        $nombre = trim(fgets(STDIN));
                                    } while (!esValido($nombre, false));
                                    $empresa->setNombre($nombre);
                                    $exito = $empresa->modificar();
                                    if ($exito) {
                                        echo "Nombre modificado.";
                                    } else {
                                        echo "ERROR: " . $this->empresa->getMensajeError();
                                    }
                                    break;

                                case 2:
                                    echo "Nueva direccion:";
                                    do {
                                        $direccion = trim(fgets(STDIN));
                                    } while (!esValido($direccion, false));
                                    $empresa->setDireccion($direccion);
                                    $exito = $empresa->modificar();
                                    if ($exito) {
                                        echo "Direccion modificada.";
                                    } else {
                                        echo "ERROR: " . $this->empresa->getMensajeError();
                                    }
                                    break;
                            }
                            echo "Ingrese 's' para seguir modificando"; //Solicita confiramcion para seguir agregando
                            if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) { //Si el usuario ingresa 's'...
                                $seguir = true; //entonces   $seguir = true
                            }
                        } while ($seguir);
                    }
                    break;

                case 3: //OPCION ELIMINAR EMPRESA
                    $empresa = new Empresa();
                    $arregloEmpresas = $empresa->listar();
                    mostrar($arregloEmpresas);
                    //Se solicita el id de la empresa a eliminar
                    echo "Ingrese el ID de la empresa a eliminar...";
                    do {
                        $idEmpresa = trim(fgets(STDIN));
                    } while (!esValido($idEmpresa, true));

                    $exito = $empresa->Buscar($idEmpresa); //$exito sera true si la operación tuvo éxito, de lo contrario sera false

                    if ($exito) { //Si la operación tuvo exito
                        $viaje = new Viaje();
                        $viajesRelacionados = $viaje->listar("idempresa=" . $idEmpresa);
                        if ($viajesRelacionados != 0) {
                            for ($i = 0; $i < count($viajesRelacionados); $i++) {
                                $viajesRelacionados[$i]->eliminar();
                            }
                        }
                        $exito = $empresa->eliminar();
                        if ($exito) {
                            echo "Empresa eliminada.";
                        } else { //... de lo contrario...
                            echo "ERROR: " . $empresa->getMensajeOperacion(); //Se imprime por pantalla el error
                        }
                    } else {
                        echo "No se encontró la empresa. ERROR: " . $empresa->getMensajeOperacion();
                    }
                    break;

                case 4: //OPCION LISTAR EMPRESAS
                    $empresa = new Empresa();
                    $arregloEmpresas = $empresa->listar();
                    mostrar($arregloEmpresas);
                    break;
                case 5: //SALIR
                    break;
            }
            break;

        case 2: //MENU RESPONSABLES
            echo
            "\033[93m[1]\033[0mCargar responsable...
        \033[93m[2]\033[0mModificar responsable...
        \033[93m[3]\033[0mEliminar responsable...
        \033[93m[4]\033[0mListar responsables...
        \033[93m[5]\033[0m\033[31mSALIR \033[0m\n";

            switch (trim(fgets(STDIN))) {

                case 1: //OPCION CARGAR RESPONSABLE
                    //Se solicitan los datos del  responsable al usuario
                    echo "N° Licencia:";
                    do {
                        $licencia = trim(fgets(STDIN));
                    } while (!esValido($licencia, true));

                    echo "Nombre:";
                    do {
                        $nombre = trim(fgets(STDIN));
                    } while (!esValido($nombre, false));

                    echo "Apellido:";
                    do {
                        $apellido = trim(fgets(STDIN));
                    } while (!esValido($apellido, false));

                    $responsable = new Responsable(); //Se crea una nueva instancia de responsable
                    $responsable->cargar(null, $licencia, $nombre, $apellido); //Se le cargan los datos ingresados por el usuario
                    $exito = $responsable->insertar(); //$exito sera true si la operación tuvo éxito, de lo contrario sera false

                    if ($exito) { //Si la operación tuvo exito, entonces se agrega el responsable al arreglo de responsables
                        echo "Responsable ingresado.";
                    } else {
                        echo "ERROR: " . $responsable->getMensajeOperacion(); //De lo contrario, imprime por pantalla el error
                    }
                    break;

                case 2: //OPCION MODIFICAR RESPONSABLES
                    $responsable = new Responsable;
                    $arregloResponsables = $responsable->listar();
                    mostrar($arregloResponsables);
                    //Se solicita el numero de responsable a modificar
                    echo "Ingrese el N° del responsable a modificar...";
                    do {
                        $nResponsable = trim(fgets(STDIN));
                    } while (!esValido($nResponsable, true));
                    do {
                        $seguir = false;
                        echo
                        "[1]Modificar N° Licencia
                    [2]Modificar nombre
                    [3]Modificar apellido";
                        switch (trim(fgets(STDIN))) {
                            case 1:
                                echo "Nuevo N° Licencia:";
                                do {
                                    $licencia = trim(fgets(STDIN));
                                } while (!esValido($licencia, true));
                                $responsable->setLicencia($licencia);
                                $exito = $responsable->modificar();
                                if ($exito) {
                                    echo "N° Licencia modificado.";
                                } else {
                                    echo "ERROR: " . $responsable->getMensajeOperacion();
                                }
                                break;
                            case 2:
                                echo "Nuevo nombre:";
                                do {
                                    $nombre = trim(fgets(STDIN));
                                } while (!esValido($nombre, false));
                                $responsable->setNombre($nombre);
                                $exito = $responsable->modificar();
                                if ($exito) {
                                    echo "Nombre modificado.";
                                } else {
                                    echo "ERROR: " . $responsable->getMensajeOperacion();
                                }
                                break;
                            case 3:
                                echo "Nuevo apellido:";
                                do {
                                    $apellido = trim(fgets(STDIN));
                                } while (!esValido($apellido, false));
                                $responsable->setApellido($apellido);
                                $exito = $responsable->modificar();
                                if ($exito) {
                                    echo "Apellido modificado.";
                                } else {
                                    echo "ERROR: " . $responsable->getMensajeOperacion();
                                }
                                break;
                        }
                        echo "Ingrese 's' para seguir modificando"; //Solicita confiramcion para seguir agregando
                        if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) { //Si el usuario ingresa 's'...
                            $seguir = true; //entonces   $seguir = true
                        }
                    } while ($seguir);
                    break;

                case 3: //OPCION ELIMINAR RESPONSABLE
                    $responsable = new Responsable;
                    $arregloResponsables = $responsable->listar();
                    mostrar($arregloResponsables);
                    //Se solicita el numero de responsable a eliminar
                    echo "Ingrese el N° del responsable a eliminar...";
                    do {
                        $nResponsable = trim(fgets(STDIN));
                    } while (!esValido($nResponsable, true));
                    $exito = $responsable->Buscar($nResponsable); //$exito sera true si la operación tuvo éxito, de lo contrario sera false
                    if ($exito) { //Si la operación tuvo exito
                        $exito = $responsable->eliminar();
                        if ($exito) {
                            echo "Responsable eliminado.";
                        } else {
                            echo "ERROR: " . $responsable->getMensajeOperacion(); //Se imprime por pantalla el error
                        }
                    } else { //... de lo contrario...
                        echo "Responsable no encontrado. ERROR: " . $responsable->getMensajeOperacion();
                    }
                    break;

                case 4: //OPCION LISTAR RESPONSABLES
                    $responsable = new Responsable;
                    $seguir = false;
                    echo
                    "[1]Listar todos los responsables
                    [2]Ver responsable de un viaje
                    [3]Ver responsable";
                    switch (trim(fgets(STDIN))) {
                        case 1:
                            $arregloResponsables = $responsable->listar();
                            mostrar($arregloResponsables);
                            break;
                        case 2:
                            $viaje = new Viaje();
                            echo "Ingrese ID de viaje:";
                            do {
                                $idViaje = trim(fgets(STDIN));
                            } while (!esValido($idViaje, true));
                            $exito = $viaje->Buscar($idViaje);
                            if ($exito) {
                                $responsable = $viaje->getResponsable();
                                echo $responsable;
                            } else {
                                echo "Viaje no encontrado. ERROR: " . $viaje->getMensajeOperacion();
                            }
                            break;
                        case 3:
                            echo "Ingrese numero de empleado:";
                            do {
                                $nEmpleado = trim(fgets(STDIN));
                            } while (!esValido($nEmpleado, true));
                            $exito = $responsable->Buscar($nEmpleado);
                            if ($exito) {
                                echo $responsable;
                            } else {
                                echo "Responsable no encontrado ERROR:" . $responsable->getMensajeOperacion();
                            }
                            break;
                    }
                    break;
                case 5:
                    break;
            }
            break;

        case 3: //MENU VIAJES
            echo
            "[1]Ingresar viaje...
        [2]Modificar viaje...
        [3]Eliminar viaje...
        [4]Listar viajes...
        \033[93m[5]\033[0m\033[31mSALIR \033[0m\n";

            switch (trim(fgets(STDIN))) {

                case 1: //OPCION CARGAR VIAJE
                    $viaje = new Viaje();
                    $empresa = new Empresa();
                    $arregloEmpresas = $empresa->listar();
                    if ($arregloEmpresas != null) {
                        echo "EMPRESAS:\n";
                        mostrar($arregloEmpresas);
                        //Se solicitan los datos de entrada al usuario
                        echo "\nIngrese el ID de la empresa propietaria del viaje:";
                        do {
                            $idEmpresa = (trim(fgets(STDIN)));
                        } while (!esValido($idEmpresa, true));
                        $exito = $empresa->Buscar($idEmpresa);
                        if ($exito) {
                            $responsable = new Responsable();
                            $arregloResponsables = $responsable->listar();
                            if ($arregloResponsables != null) {
                                echo "\nEMPLEADOS:";
                                mostrar($arregloResponsables);
                                echo "\nIngrese el numero de empleado responsable del viaje:";
                                do {
                                    $nResponsable = (fgets(STDIN));
                                } while (!esValido($nResponsable, true));
                                $exito = $responsable->Buscar($nResponsable);
                                if ($exito) {
                                    echo "Destino:";
                                    do {
                                        $destino = trim(fgets(STDIN));
                                    } while (!esValido($destino, false));

                                    echo "Importe:";
                                    do {
                                        $importe = (fgets(STDIN));
                                    } while (!esValido($importe, true));

                                    echo "Cantidad maxima de pasajeros:";
                                    do {
                                        $cantMaxPasajeros = (fgets(STDIN));
                                    } while (!esValido($cantMaxPasajeros, true));

                                    $viaje->cargar(null, $cantMaxPasajeros, $importe, $destino, $empresa, $responsable); //Se le cargan los datos ingresados
                                    $exito = $viaje->insertar();
                                    if ($exito) {
                                        echo "Viaje ingresado con exito.\n\n";
                                    } else {
                                        echo "ERROR: " . $viaje->getMensajeOperacion();
                                    }
                                } else {
                                    echo "Empleado no encontrado. ERROR: " . $responsable->getMensajeOperacion();
                                }
                            }
                        } else {
                            echo "Empresa no encontrada. ERROR: " . $empresa->getMensajeOperacion();
                        }
                    }
                    break;

                case 2: //OPCION MODIFICAR VIAJE

                    $viaje = new Viaje;
                    $responsable = new Responsable;
                    $arregloViajes = $viaje->listar();
                    mostrar($arregloViajes);
                    //Se solicita el id del viaje a modificar
                    echo "Ingrese el ID del viaje a modificar...";
                    do {
                        $idViaje = trim(fgets(STDIN));
                    } while (!esValido($idViaje, true));
                    $exito = $viaje->Buscar($idViaje);
                    if ($exito) {
                        do {
                            echo
                            "[1]Modificar destino
                    [2]Modificar importe
                    [3]Modificar cantidad maxima de pasajeros
                    [4]Modificar responsable";
                            switch (trim(fgets(STDIN))) {
                                case 1:
                                    echo "Nuevo destino:";
                                    //Cada bucle de ingreso de datos iterará hasta que los datos ingresados sean validos
                                    do {
                                        $destino = trim(fgets(STDIN));
                                    } while (esValido($destino, false));
                                    $viaje->setDestino($destino);
                                    $exito = $viaje->modificar();
                                    if ($exito) {
                                        echo "Destino modificado.";
                                    } else {
                                        "ERROR: " . $viaje->getMensajeOperacion();
                                    }
                                    break;
                                case 2:
                                    echo "Nuevo importe:";
                                    do {
                                        $importe(fgets(STDIN));
                                    } while (!esValido($importe, false));
                                    $viaje->setImporte($importe);
                                    $exito = $viaje->modificar();
                                    if ($exito) {
                                        echo "Importe modificado.";
                                    } else {
                                        "ERROR: " . $viaje->getMensajeOperacion();
                                    }
                                    break;
                                case 3:
                                    echo "Nueva cantidad maxima de pasajeros:";
                                    do {
                                        $cantMaxPasajeros(fgets(STDIN));
                                    } while (!esValido($cantMaxPasajeros, false));
                                    $viaje->setMaxPasajeros($cantMaxPasajeros);
                                    $exito = $viaje->modificar();
                                    if ($exito) {
                                        echo "Cantidad maxima de pasajeros modificada.";
                                    } else {
                                        "ERROR: " . $viaje->getMensajeOperacion();
                                    }
                                    break;
                                case 4:
                                    $responsable = new Responsable;
                                    $arregloResponsables = $responsable->listar();
                                    mostrar($arregloResponsables);
                                    echo "Ingrese el numero de empleado a asiginar como nuevo resposable:";
                                    do {
                                        $disponible = true;
                                        do {
                                            $nResponsable = (trim(fgets(STDIN)));
                                            $exito = $responsable->Buscar($nResponsable);
                                        } while (!esValido($nResponsable, false) || $exito = false);
                                        do {
                                            $i = 0;
                                            $cantViajes = count($viaje->listar());
                                            if ($viaje->listar()[$i]->getResponsable->getNumero() == $nResponsable) {
                                                $disponible = false;
                                                echo "Este empleado ya es responsable del viaje id" . $viaje->listar()[$i]->getId();
                                            } else {
                                                $i++;
                                            }
                                        } while ($disponible = true && $i < $cantViajes);
                                    } while ($disponible = false);
                                    $viaje->setResponsable($responsable);
                                    $exito = $viaje->modificar();
                                    if ($exito) {
                                        echo "Responsable actualizado.";
                                    } else {
                                        echo "ERROR: " . $viaje->getMensajeOperacion();
                                    }
                                    break;
                            }

                            echo "Ingrese 's' para seguir agregando"; //Solicita confiramcion para seguir agregando
                            if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) { //Si el usuario ingresa 's'...
                                $seguir = true; //entonces   $seguir = true
                            }
                        } while ($seguir);
                    } else {
                        echo "No se encontro el viaje. ERROR:" . $viaje->getMensajeOperacion();
                    }
                    break;
                case 3: //OPCION ELIMINAR VIAJE
                    $viaje = new Viaje();
                    $arregloViajes = $viaje->listar();
                    mostrar($arregloViajes);
                    //Se solicita el ID del viaje a eliminar
                    echo "Ingrese el ID del viaje a eliminar...";
                    do {
                        $idViaje = trim(fgets(STDIN));
                    } while (!EsValido($idViaje, true));
                    $exito = $viaje->Buscar($idViaje);
                    if ($exito) {
                        $exito = $viaje->eliminar();
                        if ($exito) {
                            echo "El viaje se eliminó con éxito.";
                        } else {
                            echo "ERROR: " . $viaje->getMensajeOperacion();
                        }
                    } else {
                        echo "No se encontró el viaje. ERROR: " . $viaje->getMensajeOperacion();
                    }
                    break;

                case 4: //OPCION LISTAR VIAJE
                    $viaje = new Viaje;
                    $arregloViajes = $viaje->listar();
                    mostrar($arregloViajes);
                    break;
            }
            break;
        case 4: //MENU PASAJEROS
            echo
            "[1]Ingresar pasajero...
            [2]Modificar pasajero...
            [3]Eliminar pasajero...
            [4]Listar pasajeros...
            \033[93m[5]\033[0m\033[31mSALIR \033[0m\n";
            switch (trim(fgets(STDIN))) {
                case 1:
                    //Agregar pasajeros
                    do { //En cada iteracion...
                        $viaje = new Viaje();
                        $arregloViajes = $viaje->listar();
                        $seguir = false; //Se inicializa la variable $seguir=false;
                        $pasajero = new Pasajero();
                        //Se solicitan los datos de los pasajeros al usuario
                        echo "DNI:";
                        //Cada bucle de ingreso de datos iterará hasta que los datos ingresados sean validos
                        do {
                            $dni = trim(fgets(STDIN));
                        } while (!esValido($dni, true) || $pasajero->Buscar($dni));
                        echo "Nombre:";
                        do {
                            $nombre = trim(fgets(STDIN));
                        } while (!esValido($nombre, false));
                        echo "Apellido:";
                        do {
                            $apellido = trim(fgets(STDIN));
                        } while (!esValido($apellido, false));

                        do {
                            $telefono = trim(fgets(STDIN));
                        } while (!esValido($telefono, true));

                        echo "\nVIAJES:\n\n";
                        mostrar($arregloViajes);
                        echo "Ingrese el ID del viaje al que pertenece el pasajero";
                        do {
                            $idViaje = trim(fgets(STDIN));
                        } while (!esValido($idViaje, true));
                        $exito = $viaje->buscar($idViaje);
                        if ($exito) {
                            if ((count($viaje->getPasajeros()) < $viaje->getMaxPasajeros())) {
                                $pasajero->cargar($dni, $nombre, $apellido, $telefono, $viaje);
                                $exito = $pasajero->insertar();
                                if ($exito) {
                                    echo "El pasajero se insertó con éxito.";
                                    $arregloPasajeros = $pasajero->listar();
                                    $viaje->setPasajeros($arregloPasajeros);
                                } else {
                                    "ERROR :" . $pasajero->getMensajeOperacion();
                                }
                            } else {
                                echo "El viaje alcanzó su maxima capacidad.";
                            }
                        } else {
                            echo "No se encontró el viaje. ERROR: " . $viaje->getMensajeOperacion();
                        }
                        echo "Ingrese 's' para seguir agregando"; //Solicita confiramcion para seguir agregando
                        if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) { //Si el usuario ingresa 's'...
                            $seguir = true; //entonces   $seguir = true
                        }
                    } while ($seguir); //El bucle de ingreso de pasajeros seguirá iterando
                    break;

                case 2: //MODIFICAR PASAJERO
                    $pasajero = new Pasajero();
                    $viaje = new Viaje();
                    $arregloPasajeros = $pasajero->listar();
                    echo "PASAJEROS:\n";
                    mostrar($arregloPasajeros);
                    echo "Ingrese el DNI del pasajero a modificar";
                    do {
                        $dni = trim(fgets(STDIN));
                    } while (!esValido($dni, true));
                    $exito = $pasajero->Buscar($dni);
                    if ($exito) {
                        do {
                            $seguir = false;
                            echo "[1]Modificar Nombre
                                [2]Modificar apellido
                                [3]Modificar telefono
                                [4]Modificar el viaje";
                            switch (trim(fgets(STDIN))) {
                                case 1:
                                    do {
                                        $nombre = trim(fgets(STDIN));
                                    } while (!esValido($nombre, false));
                                    $pasajero->setNombre($nombre);
                                    $exito = $pasajero->modificar();
                                    if ($exito) {
                                        echo "Nombre modificado con éxito.";
                                    } else {
                                        echo "ERROR: " . $pasajero->getMensajeOperacion();
                                    }
                                    break;
                                case 2:
                                    do {
                                        $apellido = trim(fgets(STDIN));
                                    } while (!esValido($apellido, false));
                                    $pasajero->setApellido($apellido);
                                    $exito = $pasajero->modificar();
                                    if ($exito) {
                                        echo "Apellido modificado con éxito.";
                                    } else {
                                        echo "ERROR: " . $pasajero->getMensajeOperacion();
                                    }
                                    break;
                                case 3:
                                    do {
                                        $telefono = trim(fgets(STDIN));
                                    } while (!esValido($telefono, true));
                                    $pasajero->setTelefono($telefono);
                                    $exito = $pasajero->modificar();
                                    if ($exito) {
                                        echo "Telefono modificado con éxito.";
                                    } else {
                                        echo "ERROR: " . $pasajero->getMensajeOperacion();
                                    }
                                    break;
                                case 4:
                                    echo "VIAJES:\n";
                                    mostrar($arregloViajes);
                                    echo "Ingrese el ID del viaje";
                                    do {
                                        $idViaje = trim(fgets(STDIN));
                                    } while (!esValido($dni, true));
                                    $exito = $viaje->buscar($idViaje);
                                    if ($exito) {
                                        if (count($viaje->getPasajeros()) < $viaje->getMaxPasajeros()) {
                                            $pasajero->setViaje($viaje);
                                            $exito = $pasajero->modificar();
                                            if ($exito) {
                                                echo "Viaje modificado con éxito.";
                                            } else {
                                                echo "ERROR: " . $pasajero->getMensajeOperacion();
                                            }
                                        } else {
                                            echo "El viaje elegido esta lleno.";
                                        }
                                    } else {
                                        echo "Viaje no encontrado. ERROR: " . $viaje->getMensajeOperacion();
                                    }
                                    break;
                            }
                            echo "Ingrese 's' para seguir agregando"; //Solicita confiramcion para seguir agregando
                            if (strncasecmp('s', trim(fgets(STDIN)), 1) == 0) { //Si el usuario ingresa 's'...
                                $seguir = true; //entonces   $seguir = true
                            }
                        } while ($seguir = true);
                    }
                    break;
                case 3: //ELIMINAR PASAJERO
                    $pasajero = new Pasajero;
                    //$arregloPasajeros = $pasajero->listar();
                    echo "PASAJEROS:\n";
                    //mostrar($arregloPasajeros);
                    echo "Ingrese el dni del pasajero a eliminar:";
                    do {
                        $dni = trim(fgets(STDIN));
                    } while (!esValido($dni, true));
                    $exito = $pasajero->Buscar($dni);
                    if ($exito) {
                        $exito = $pasajero->eliminar();
                        if ($exito) {
                            echo "Pasajero eliminado.";
                        } else {
                            echo "ERROR: " . $pasajero->getMensajeOperacion();
                        }
                    } else {
                        echo "Pasajero no encontrado. ERROR: " . $pasajero->getMensajeOperacion();
                    }
                    break;
                case 4: //LISTAR PASAJERO
                    $pasajero = new Pasajero;
                    $arregloPasajeros = $pasajero->listar();
                    echo "PASAJEROS:\n";
                    mostrar($arregloPasajeros);
                    break;
                case 5:
                    break;
            }
            break;

        case 5:
            $salir = true;
            break;
    }
} while (!$salir);



function mostrar($arreglo)
//Imprime todos los elementos de un arreglo
{
    $cant = count($arreglo);
    for ($i = 0; $i < $cant; $i++) {
        echo $arreglo[$i] . "\n";
    }
}

function esValido($valor, $esNumerico) //Funcion que retorna si el valor ingresado es valido
{
    $retorno = false; //inicializamos la variable retorno en false
    if (is_numeric($valor) && $esNumerico) { //Si el valor solicitado debe ser un numero y el valor ingresado es un numero
        $retorno = true; //retorna true
    } else if (!is_numeric($valor) && !$esNumerico) { //Si el valor solicitado no debe ser un numero y el valor ingresado no es un numero
        $retorno = true; //retorna true
    } else {
        echo "\033[31mEl valor ingresado no es valido.\033[0m\n"; //Si no, retorna false
    }
    return $retorno;
}
