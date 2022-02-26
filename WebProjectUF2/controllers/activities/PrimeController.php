<?php
declare(strict_types=1);
include_once '../../model/MathFunctions.php';

//RECUPERAMOS LOS DATOS QUE HAN SIDO CAPTURADOS CON GET UTILIZANDO
//EL MISMO VALOR DE LAS VARIABLES EN EL FORMULARIO ORIGEN
if (($value = filter_input(INPUT_POST, "num")) != null) {
    $esprimo = true;
    $savedivisors = filter_input(INPUT_POST, "viewdivisors");

    $maxdiv = sqrt($value);
    for ($i = 2; $i <= $maxdiv and $esprimo == true; $i++) {
        if ($value % $i == 0) {
            $esprimo = false;
        }
    }

    print "El valor $value ";
    if ($esprimo) {
        print "es primer";
    } else {
        print "no es primer";
        if ($savedivisors) {
            print "<br><br>LlISTA DE DIVISORS<br>";
            $divisors = divisors($value);
            for ($i = 0; $i < count($divisors); $i++) {
                print "<br>$divisors[$i]";
            }
        }
    }
}
print "  <p><a href=\"../../views/activities/NumbersView.html\">Volver a la página anterior</a></p>\n";
?> 