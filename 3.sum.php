<?php

function sumMultiples($limit) {
    $sum = 0;

    for ($i = 1; $i < $limit; $i++) {
        if ($i % 3 === 0 || $i % 5 === 0) {
            $sum += $i;
        }
    }

    return $sum;
}

$limit = 1000;
$result = sumMultiples($limit);

echo "Сумма всех чисел меньше $limit, кратных 3 или 5, равна: $result";

?>