<?php
include 'Calculadora.php';
//Variables
$num1;
$num2;
$operador;
$eleccion = true;
do {
    echo "\n*********CALCULADORA*********\n
Ingrese el primer operando:";
    $num1 = fgets(STDIN);
    echo "Ingrese el segundo operando:";
    $num2 = fgets(STDIN);
    $calculo = new Calculadora($num1, $num2);
    echo "Seleccione la operacion:\n
(1) -
(2) +
(3) *
(4) / \n";
    switch (fgets(STDIN)) {
        case 1:
            echo $num1 . "-" . $num2 . "=" . $calculo->restar() . "\n";
            break;
        case 2:
            echo $num1 . "+" . $num2 . "=" . $calculo->sumar() . "\n";
            break;
        case 3:
            echo $num1 . "*" . $num2 . "=" . $calculo->multiplicar() . "\n";
            break;
        case 4:
            if ($num2 != 0) {
                echo $num1 . "/" . $num2 . "=" . $calculo->dividir() . "\n";
            } else {
                echo "¡No se puede dividir por cero!\n";
            };
            break;
    }
} while ($eleccion);
