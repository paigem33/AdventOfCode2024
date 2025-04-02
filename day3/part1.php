<?php

$input = file_get_contents("./input.txt");
// $input = "xmul(2,4)%&mul[3,7]!@^do_not_mul(5,5)+mul(32,64]then(mul(11,8)mul(8,5))";

preg_match_all('/mul\(\d{1,3},\d{1,3}\)/', $input, $matches);

$total = 0;
foreach($matches[0] as $match){
    preg_match_all('/\((\d+),(\d+)\)/', $match, $ints);
    $first = (int)$ints[1][0];
    $second = (int)$ints[2][0];
    $total += $first * $second;
}
print($total);