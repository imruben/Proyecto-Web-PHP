<?php

declare(strict_types=1);
session_start();    //intruccion para poder trabajar con sesiones
include_once '../../model/StringChallengeFunctions.php';

if (isset($_SESSION["ingame"]) == null) {    //si aun no ha empezado el juego
    //valores iniciales de las variables de sesion para uso local
    $_SESSION["ingame"] = 1;
    $_SESSION["gamePoints"] = initialsPoints();
    setcookie('inStringChallenge', "1", 0, '/', 'localhost');
} else if (($posibleColor = filter_input(INPUT_POST, "result")) != null) {  //juego iniciado y el usuario ha enviado una respuesta
    //comparamos resultado con la respuesta recibida
    if (strcmp($_SESSION["colorAleat"], $posibleColor) == 0) {
        $_SESSION["gamePoints"] += correctAnswer();
        //cargamos valores en las cookies para que puedan ser leidas en la vista
        setcookie('trueResponse', "1", 0, '/', 'localhost');

        if ($_SESSION["gamePoints"] >= objective()) {
            setcookie('points', (string) (filter_input(INPUT_COOKIE, 'points') + $_SESSION["gamePoints"]), 0, '/', 'localhost');
            $level = filter_input(INPUT_COOKIE, 'level');
             
            if ($level == 2) {                  //si corresponde, lo subimos de nivel
                setcookie('level', (string) ($level + 1), 0, '/', 'localhost');
            }
            //damos por finalizado el reto eliminando la cookie i la variable de sesion
            unset($_SESSION["ingame"]);
        }
    } else {
        $_SESSION["gamePoints"] -= badAnswer();
        setcookie('trueResponse', '0', 0, '/', 'localhost');
        if ($_SESSION["gamePoints"] <= 0) {
            //damos por finalizado el reto eliminando la cookie i la variable de sesion
            unset($_SESSION["ingame"]);
        }
    }
}
//cargamos valores en las cookies para que puedan ser leidas en la Vista y presentarle el reto al usuario
setcookie('gamePoints', (string) $_SESSION["gamePoints"], 0, '/', 'localhost');
setcookie('objective', (string) objective(), 0, '/', 'localhost');
setcookie('correct', (string) correctAnswer(), 0, '/', 'localhost');
setcookie('error', (string) badAnswer(), 0, '/', 'localhost');

if (isset($_SESSION["ingame"]) != null) {    //si continua el reto
    $solution = "";
    $color = "";
    newChallenge($color, $solution);        //llamada a la funcion del modelo del reto
    //carggamos en la variable de sesion la solucion para poder compararla con la respuesta del usuario
    $_SESSION["colorAleat"] = $solution;
    setcookie('newColor', $color, 0, '/', 'localhost');
} else {
    setcookie('inStringChallenge', "0", 0, '/', 'localhost');    
    setcookie('trueResponse', "1", -1, '/', 'localhost');   //elimina la cookie
}

//cargamos la vista
header('location: ../../views/challenges/StringChallengeView.php');
