<?php
declare(strict_types=1);

if (($value = filter_input(INPUT_POST, "pais")) != null) {

    $esprimo = true;

    $key = filter_input(INPUT_POST, "key");

    $countries = [
        ["pais" => "España", "capital" => "Madrid", "poblacio" => "4 milions"],
        ["pais" => "Portugal", "capital" => "Lisboa", "poblacio" => "0.5 milions"],
        ["pais" => "Francia", "capital" => "Paris", "poblacio" => "6 milions"],
        ["pais" => "Italia", "capital" => "Roma", "poblacio" => "5 milions"]
    ];

    $pos = -1;
    for ($i=0; $i < count($countries) ; $i++) {
        if ($countries[$i]["pais"] == $value) {
            $pos = $i;
        }
    }

    if ($pos == -1) {
        echo "<br><br>No trobem dades del país indicat";
    } else {
        foreach ($countries[$pos] as $index => $valor) {
            echo "$index:  ---- >  $valor<br>";
        }
    }

    if ($key) {
        echo "<br><br>Paissos ordenats per $key";

        $column = array_column($countries, $key);
        array_multisort($column, $countries, SORT_ASC);

        $pos = 1;
        foreach ($countries as $fila) {
            echo "<br><br>Pais $pos.";
            foreach ($fila as $index => $valor) {
                echo "<br>$index : $valor";
            }
            $pos++;
        }
    }
} else {
    echo "NECESITAMOS EL NOMBRE DEL PAIS PARA PODER OPERAR <br><br>";
}

print "  <p><a href=\"../../views/activities/ArrayAssocView.html\">Volver a la página anterior</a></p>\n";


