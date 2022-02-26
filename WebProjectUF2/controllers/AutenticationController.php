<?php
declare(strict_types=1);

include_once '../model/Autentication.php';

if (($username = filter_input(INPUT_POST, 'user')) != null and
        ($passwd = filter_input(INPUT_POST, 'passwd')) != null) {
    
    $datauser = checkUser($username, $passwd);
       
    if (count($datauser) != 0) {
        setcookie('user', $username, 0, '/', 'localhost');
        setcookie('level', (string)$datauser["level"], 0, '/', 'localhost');
        setcookie('points', (string)$datauser["points"], 0, '/', 'localhost');
        setcookie('loginAttempts', '0', time()-3600, '/', 'localhost');

        header('location: ../views/Main.php');
    } else {
        if ((filter_input(INPUT_COOKIE, 'loginAttempts') ) < 5) {
            setcookie('loginAttempts', (string)(filter_input(INPUT_COOKIE, 'loginAttempts') + 1), time() + 3600, '/', 'localhost');
        } 
        header('location: ../views/BadLogin.php');
    }
} else {
    header('location: ../views/BadLogin.php');
}

