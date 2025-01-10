<?php

include('input.php');

// The levels are either all increasing or all decreasing.
// Any two adjacent levels differ by at least one and at most three

$safe = 0;
foreach($input_array as $row){
    $array_row = explode(" ", $row);
    if(isIncreasingOrDecreasing($array_row)){
        for($i = 0; $i < count($array_row) - 1; $i++){
            if(($array_row[$i] == $array_row[$i + 1]) || !isIncreasingOrDecreasingWithinRange($array_row[$i], $array_row[$i + 1])){
                continue 2;
            }
        };
        $safe++;
    }
    
}
print($safe);

function isIncreasingOrDecreasingWithinRange($first, $second){
    if(abs($first - $second) >= 1 && abs($first - $second) <= 3){
        return true;
    }
    return false;
}

function isIncreasingOrDecreasing($array){
    $changes = 0;
    $current = null;
    $iteration = 0;
    while($changes < 2 && $iteration < count($array) - 1){
        if(($array[$iteration + 1] > $array[$iteration]) && $current == null){
            $changes++;
            $current = 'increasing';
        } else if(($array[$iteration + 1] < $array[$iteration]) && $current == null){
            $changes++;
            $current = 'decreasing';
        } else if(($array[$iteration + 1] > $array[$iteration]) && $current == 'decreasing'){
            $changes++;
        } else if(($array[$iteration + 1] < $array[$iteration]) && $current == 'increasing'){
            $changes++;
        }
        $iteration++;
    }
    if($changes != 1){
        return false;
    }
    return true;
}