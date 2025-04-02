<?php

$input = file_get_contents("./input.txt");
// $input = "xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))";

preg_match_all('/mul\(\d{1,3},\d{1,3}\)|do\(\)|don\'t\(\)/', $input, $matches);

print_r($matches);

$donts = array_keys($matches[0], "don't()");
$dos = array_keys($matches[0], "do()");

$total = 0;
foreach($matches[0] as $index => $match){

    if(in_array($index, $donts) || in_array($index, $dos)){
        continue; // if not a mul(), skip
    }

    $closest_do = getSmallestClosest($index, $dos);
    $closest_dont = getSmallestClosest($index, $donts);

    // if the mul is before the first dont index
    // need to also check to make sure the mul is after a do but before a dont
    if(($index < $donts[0]) || ($index > $closest_do && $closest_do > $closest_dont)){ 
        preg_match_all('/\((\d+),(\d+)\)/', $match, $ints);
        $first = (int)$ints[1][0];
        $second = (int)$ints[2][0];
        $total += $first * $second;
    }

}
print($total);

function getSmallestClosest($search, $array) {
    $closest = null;
    foreach ($array as $item) {
       if ($closest === null || abs($search - $closest) > abs($item - $search)) {
        if($item > $search){
            return $closest;
        }
          $closest = $item;
       }
    }
    return $closest;
 }