<?php

include('input.php');

// The levels are either all increasing or all decreasing.
// Any two adjacent levels differ by at least one and at most three

$safe = 0;
foreach($input_array as $key => $row){
    $row_safe = false;
    $array_row = explode(" ", $row);
    if(validateArray($array_row)){
        $safe++;
    } else {
        // call method with all possible variations, if any are true, safe++
        $new_arrays = removeEachIndex($array_row);
        foreach($new_arrays as $array){
            if(validateArray($array)){
                $safe++;
                break;
            }
        }
    }
    
}
print($safe);

function removeEachIndex($arr) {
    $result = [];
    foreach ($arr as $index => $value) {
        $temp = $arr;
        unset($temp[$index]);
        $result[] = array_values($temp);
    }
    return $result;
}

function validateArray($array_row){
    $increasing = isIncreasingOrDecreasing($array_row);
    $in_range = true;

    for($i = 0; $i < count($array_row) - 1; $i++){
        if(($array_row[$i] == $array_row[$i + 1]) || !isIncreasingOrDecreasingWithinRange($array_row[$i], $array_row[$i + 1])){
            return false;
        }
    };
    return $increasing;
}

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