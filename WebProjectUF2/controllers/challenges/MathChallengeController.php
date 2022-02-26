<?php

declare(strict_types=1);
session_start();    //intruccion para poder trabajar con sesiones
include_once '../../model/MathChallengeFunctions.php';

$pointsForChallenge = 1000;

function getPoints(int $points): int {
    if ($_SESSION["continuedSuccess"] == objective()) {
        return (int) ($points * objective() / $_SESSION["attempts"]);
    } else {
        return 0;
    }
}

if (isset($_SESSION["inmathgame"]) == null) {    //si aun no ha empezado el juego
    //valores iniciales de las variables de sesion para uso local
    $_SESSION["inmathgame"] = 1;
    $_SESSION["continuedSuccess"] = 0;
    $_SESSION["attempts"] = 0;
    setcookie('inMathChallenge', "1", 0, '/', 'localhost');
} else if (($resultPropossed = filter_input(INPUT_POST, "result")) != null) { //juego iniciado y el usuario ha enviado una respuesta   
    if ($resultPropossed == $_SESSION["result"]) {          //comparamos resultado con la respuesta recibida
        setcookie('success', '1', 0, '/', 'localhost');
        $_SESSION["continuedSuccess"]++;
    } else {
        setcookie('success', '0', 0, '/', 'localhost');
        $_SESSION["continuedSuccess"] = 0;
    }
    $_SESSION["attempts"]++;
    setcookie('continuedSuccess', (string) $_SESSION["continuedSuccess"], 0, '/', 'localhost');

    if ($_SESSION["continuedSuccess"] == objective()) {
        $level = filter_input(INPUT_COOKIE, 'level');
        $points = filter_input(INPUT_COOKIE, 'points') + getPoints($pointsForChallenge);
        setcookie('points', (string)$points, 0, '/', 'localhost');
        setcookie('score', (string) getPoints($pointsForChallenge), 0, '/', 'localhost');
        setcookie('gamepoints', (string) $pointsForChallenge, 0, '/', 'localhost');

        if ($level == 1) {
            setcookie('level', (string) ($level + 1), 0, '/', 'localhost');
        }
        unset($_SESSION["inmathgame"]);
        setcookie('inMathChallenge', "0", 0, '/', 'localhost');
    }
}

if (isset($_SESSION["inmathgame"]) != null) {   //continuamos con el reto
    $result = 0.0;
    $challenge = "";
    newChallenge($challenge, $result);        //llamada a la funcion del modelo del reto
    //carggamos en la variable de sesion la solucion para poder compararla con la respuesta del usuario
    $_SESSION["result"] = $result;

    //cargamos valores en las cookies para que puedan ser leidas en la Vista y presentarle el reto al usuario
    setcookie('newchallenge', $challenge, 0, '/', 'localhost');
    setcookie('objective', (string) objective(), 0, '/', 'localhost');
    setcookie('attempts', (string) $_SESSION["attempts"], 0, '/', 'localhost');
}

//cargamos la vista
header('location: ../../views/challenges/MathChallengeView.php');
