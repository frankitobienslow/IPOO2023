<?php
include 'Reloj.php';
$seguir = true;
do {
    echo "Ingrese el horario actual:\n
hora: ";
    $hora = fgets(STDIN);
    if ($hora >= 24) {
        $seguir = false;
        echo "¡El dia tiene 24 horas!\n";
    } else {
        if ($hora == null) {
            $hora = 00;
        }
        $seguir = true;
    }
} while (!$seguir);
do {
    echo "\n minutos: ";
    $minutos = fgets(STDIN);
    if ($minutos >= 60) {
        $seguir = false;
        echo "¡Una hora tiene 60 minutos!\n";
    } else {
        if ($minutos == null) {
            $minutos = "00";
            $seguir = true;
        }
    }
} while (!$seguir);

do {
    echo "\n segundos: ";
    $segundos = fgets(STDIN);
    if ($segundos >= 60) {
        $seguir = false;
        echo "¡Un minuto tiene 60 segundos!\n";
    } else {
        if ($segundos == null) {
            $segundos = "00";
        }
        $seguir = true;
    }
} while (!$seguir);
$horario = new Reloj($hora, $minutos, $segundos);
echo "La hora actual es " . $horario->getHoras() . ":" . $horario->getMinutos() . ":" . $horario->getSegundos();
do {
    echo "¿Incrementar?(S/N)";
    if (strcasecmp(fgets(STDIN), 's') != 0) {
        $horario->incremento();
        echo "La hora actual es " . $horario->getHoras() . ":" . $horario->getMinutos() . ":" . $horario->getSegundos() . "\n";
    } else {
        $seguir = false;
    }
} while ($seguir);
echo "FIN PROGRAMA";
