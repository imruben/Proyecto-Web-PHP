<?php

declare(strict_types=1);
session_start();

include_once '../../model/QuestChallengeFunctions.php';

//CUANDO EL JUEGO NO HA EMPEZADO
if (isset($_SESSION["inQuestChallenge"]) == null) {
    $_SESSION["correctAnswer"] = 0;
    $_SESSION['inQuestChallenge'] = 1;
    $_SESSION['errors'] = 0;
    setcookie('inQuestChallenge', "1", 0, '/', 'localhost');
    setcookie('correctAnswer', (string) $_SESSION["correctAnswer"], 0, '/', 'localhost');
    setcookie('errors', (string) $_SESSION["errors"], 0, '/', 'localhost');
    $_SESSION["answersUsed"] = [];

//SI EL JUEGO HA COMENZADO
} else if (($respuesta = filter_input(INPUT_POST, "answer")) != null) {

    //RESPUESTA CORRECTA
    if ($respuesta == $_SESSION["solution"]) {
        $_SESSION["correctAnswer"]++;

        //RESPUESTA INCORRECTA
    } else {
        $_SESSION['errors']++;
    }

    setcookie('correctAnswer', (string) $_SESSION["correctAnswer"], 0, '/', 'localhost');
    setcookie('errors', (string) $_SESSION["errors"], 0, '/', 'localhost');

    if ($_SESSION['errors'] == maxErrors()) {
        unset($_SESSION["inQuestChallenge"]);
    }
    
    //LLEGO AL OBJETIVO DE PREGUNTAS CORRECTAS (gano el juego)
    if ($_SESSION["correctAnswer"] == objective()) {

        //subimos un nivel al usuario
        $level = filter_input(INPUT_COOKIE, 'level');
        if ($level == 1) {
            setcookie('level', (string) ($level + 1), 0, '/', 'localhost');
        }
        unset($_SESSION["inQuestChallenge"]);
    }
}


setcookie('inQuestChallenge', (string) $_SESSION["inQuestChallenge"], 0, '/', 'localhost');
//Cargamos el objetivo y los errores con las funciones
setcookie('objective', (string) objective(), 0, '/', 'localhost');
setcookie('maxErrors', (string) maxErrors(), 0, '/', 'localhost');

//CREAMOS PREGUNTA SIEMPRE QUE ESTEMOS EN EL JUEGO
if (isset($_SESSION["inQuestChallenge"]) != null) {

    //pregunta inicial
    $answer = [];
    $solution = "";

    $option = rand(1, 7);

    print "<BR>OPCION ORIGINAL: $option <br> ";

    $i = 0;
    //si esa opcion esta en el bucle vuelve a buscar otra opcion random
    while (in_array($option, $_SESSION["answersUsed"])) {
        print "<BR>OPCION NUEVA (ORIGINAL REPETIDA): $option  <br>";
        $option = rand(1, 7);
        $i++;
    }

    //Guardo la opcion definitiva en el array session
    $_SESSION["answersUsed"][] = $option;

    print "<br>ARRAY SESSION: ";
    print_r($_SESSION["answersUsed"]);
    print "<br><br>";

    NewQuestChallenge($answer, $solution, $option);

    
      $_SESSION["solution"] = $solution;
      setcookie('solucion', $solution, 0, '/', 'localhost');
     
    
    //Pasar el array con la pregunta final a string para el view 
    $finalAnswer = "";

    print_r($answer);
    print "<br>";
    print "<br>";
    foreach ($answer as $index => $data) {

        $finalAnswer = $finalAnswer . $index . " - " . $data . "<br>";
    }


    print $finalAnswer;

    setcookie('newchallenge', $finalAnswer, 0, '/', 'localhost');
}

//Volvemos al view con un header
header('location: ../../views/challenges/QuestChallengeView.php');
