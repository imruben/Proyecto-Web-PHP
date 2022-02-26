<?php

declare (strict_types=1);


function objective(): int {
    return 5;
}

function maxErrors(): int {
    return 3;
}

    function NewQuestChallenge(array &$answer, string &$solution, int $option): int {

    
    switch ($option) {
        case 1:
            $answer = ["Pregunta" => "¿Las jirafas duermen?", "1" => "Si", "2" => "A mi que me cuentas soy informatico   ",
                "3" => "Que es una jirafa?", "4" => "Imposible si se tumba no se levanta"];
            $solution = "1";
            break;
        case 2:
            $answer = ["Pregunta" => "¿Cuantas horas duerme un koala?", "1" => "No duerme", "2" => "4 dias",
                "3" => "Hasta que se cae del arbol", "4" => "22 horas"];
            $solution = "4";
            break;
        case 3:
            $answer = ["Pregunta" => "¿Cual es el animal con mas dientes del mundo?", "1" => "El pez gato",
                "2" => "La ballena", "3" => "Mi abuela", "4" => "El tiburón"];
            $solution = "1";
            break;
        case 4:
            $answer = ["Pregunta" => "¿En que año Colon llegó a America?", "1" => "Hace dos años",
                "2" => "America no existe", "3" => "En 1492", "4" => "En 1942"];
            $solution = "3";
            break;
        case 5:
            $answer = ["Pregunta" => "¿Como se llama el mago del Señor de Los Anillos?", "1" => "Dumbledore",
                "2" => "Gandalf", "3" => "Carmen de Mairena", "4" => "Mickey Mouse"];
            $solution = "2";
            break;
        case 6:
            $answer = ["Pregunta" => "¿Cual es el cuerpo más pesado?", "1" => "El universo",
                "2" => "La Via Lactea", "3" => "El Sergi", "4" => "La Tierra"];
            $solution = "3"; 
            break;
        case 7:
            $answer = ["Pregunta" => "¿Quien es el actor de Torrente?", "1" => "Mi padre",
                "2" => "Santiago Segura", "3" => "Brad Pitt", "4" => "Samuel L. Jackson"];
            $solution = "2";
            break;
    }
    
    return $option;
    
}

/*
$answer = [];
$solution = "";


$opcion = NewQuestChallenge($answer, $solution);

print "Answer: ";
print_r($answer);
print "<br>";
print "<br><br>";


print_r($answer);

print "Solution: $solution<br>";

print $opcion;
 */

