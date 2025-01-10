<?php

include('input.php');

// The levels are either all increasing or all decreasing.
// Any two adjacent levels differ by at least one and at most three

$safe = 0;
foreach($input_array as $row){
    $array_row = explode(" ", $row);
    for($i = 0; $i < count($array_row) - 1; $i++){
        if(($array_row[$i] != $array_row[$i + 1]) && isIncreasingOrDecreasingWithinRange($array_row[$i], $array_row[$i + 1])){

        }
    };
}

function isIncreasingOrDecreasingWithinRange($first, $second){
    if(abs($first - $second) >= 1 && abs($first - $second) <= 3){
        return true;
    }
    return false;
}