<?php
declare(strict_types=1);
//RECUPERAMOS LOS DATOS QUE HAN SIDO CAPTURADOS CON GET UTILIZANDO
//EL MISMO VALOR DE LAS VARIABLES EN EL FORMULARIO ORIGEN
if (($num1 = filter_input(INPUT_POST, "valor1") ) != null and
        ($num2 = filter_input(INPUT_POST, "valor2") ) != null) {

    $operation = filter_input(INPUT_POST, "oper");

    switch ($operation) {
        case "suma":
            $result = $num1 + $num2;
            echo "Has escogido suma entre $num1 y $num2 = $result";
            break;
        case "resta":
            $result = $num1 - $num2;
            echo "Has escogido resta entre $num1 y $num2 = $result";
            break;
        case "multiplicacion":
            $result = $num1 * $num2;
            echo "Has escogido multiplicacion entre $num1 y $num2 = $result";
            break;
        case "division":
            if ($num2 == 0) {
                echo "No voy a dividir por 0 ($num1 / $num2)";
            } else {
                $result = $num1 / $num2;
                echo "Has escogido division entre $num1 y $num2 = $result";
            }
            break;
    }
} else {
    echo "NECESITAMOS 2 VALORES NUMERICOS PARA PODER OPERAR <br><br>";
}
print "  <p><a href=\"../../views/activities/NumbersView.html\">Volver a la página anterior</a></p>\n";
?> 
