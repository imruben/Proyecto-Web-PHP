<?php

function divisors(int $num): array {
    $divisors = [];

    if ($num > 0) {
        $divisors[] = 1;
        $divisors[] = $num;
        $maxdiv = sqrt($num);

        if ($num % 2 == 0) {
            $divisors[] = 2;
            $divisors[] = $num / 2;
            $inc = 1;
        } else {
            $inc = 2;
        }
        
        for ($div = 3; $div <= $maxdiv; $div += $inc) {
            if ( $num % $div == 0 ) {
                $divisors[] = $div;
                if ($div != $maxdiv) {
                    $divisors[] = $num / $div;
                }
            }
        }
        sort($divisors);
    }
    return $divisors;
}




