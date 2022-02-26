<?php

declare(strict_types=1);

function objective(): int {
    return 100;
}

function initialsPoints(): int {
    return 40;
}

function newChallenge(string &$color, string &$answer): void {
    $colores = ["amarillo", "marengo", "naranja", "purpura", "turquesa", "marfil", "lavanda", "magenta",
        "cian", "beige", "fucsia", "mostaza", "ocre", "malva", "violeta", "granate"];
    $tam = count($colores);
    $posAleat = rand(0, $tam - 1);
    $answer = $colores[$posAleat];
    $color = str_shuffle($answer);
}

function badAnswer(): int {
    return 20;
}

function correctAnswer(): int {
    return 10;
}
