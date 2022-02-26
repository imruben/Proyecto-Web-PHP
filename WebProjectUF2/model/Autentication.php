<?php

declare(strict_types=1);

function checkUser(String $username, String $password): array {
    $users = [
        ["user" => "profe", "password" => "admin", "level" => 10, "points" => 1000],
        ["user" => "alumno", "password" => "alumno", "level" => 1, "points" => 0],
        ["user" => "alumno2", "password" => "alumno2", "level" => 2, "points" => 0],
        ["user" => "ruben", "password" => "ruben", "level" => 99999999, "points" => 9999999]
    ];
    
    foreach ($users as $row) {
        if ($row["user"] == $username and $row["password"] == $password) {
            return $row;
        }
    }   
    return [];
}
