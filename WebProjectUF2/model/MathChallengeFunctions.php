<?php

declare(strict_types=1);

function objective(): int {
    return 5;
}

function newChallenge(string &$challenge, float &$solution): void {
    $firstAleatValue = rand(1, 13);
    $secondAleatValue = rand(1, 13);
    $operAleat = "";
    switch (rand(0, 3)) {
        case 0: $operAleat = "+";
            break;
        case 1: $operAleat = "-";
            break;
        case 2: $operAleat = "*";
            break;
        case 3: $operAleat = "/";
            break;
    }
    $solution = challengeResult($firstAleatValue, $secondAleatValue, $operAleat);
    $challenge = $firstAleatValue . " " . $operAleat . " " . $secondAleatValue . " = ";
}

function challengeResult(int $num1, int $num2, string $oper): int {
    $result = 0;
    switch ($oper) {    //realizamos la operacion que corresponda
        case "+":
            $result = $num1 + $num2;
            break;
        case "-":
            $result = $num1 - $num2;
            break;
        case "*":
            $result = $num1 * $num2;
            break;
        case "/":
            $result = (int) ($num1 / $num2);
            break;
    }
    return $result;
}
