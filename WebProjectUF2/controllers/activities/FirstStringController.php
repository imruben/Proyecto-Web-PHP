<?php
declare(strict_types=1);
if (($textoOrig = filter_input(INPUT_POST, "texto")) != null) {
    $textoOrig = trim($textoOrig);
    $contVocales = 0;
    $textoOrig = strtolower($textoOrig);

    for ($pos = 0; $pos < strlen($textoOrig); $pos++) {

        if ($textoOrig[$pos] == 'a' || $textoOrig[$pos] == 'e' || $textoOrig[$pos] == 'i' ||
            $textoOrig[$pos] == 'o' || $textoOrig[$pos] == 'u') {
            $contVocales++;
        }
    }
    print "<br><br>He trobat:  $contVocales vocals";
} else {
    echo "<br><br>Has de pasar algun text a processar...";
}
print "  <p><a href=\"../../views/activities/StringsView.html\">Volver a la página anterior</a></p>\n";
