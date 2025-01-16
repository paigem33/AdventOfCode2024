<?php

include('input.php');

// $input = 
// "7 6 4 2 1
// 1 2 7 8 9
// 9 7 6 2 1
// 1 3 2 4 5
// 8 6 4 4 1
// 1 3 6 7 9";

// $input = str_replace("\r", "", $input);
// $input_array = explode("\n", trim($input));

// The levels are either all increasing or all decreasing.
// Any two adjacent levels differ by at least one and at most three

$safe = 0;
foreach($input_array as $row){
    $array_row = explode(" ", $row);
    if(isIncreasingOrDecreasing($array_row)){ // this is skipping ones that would work if one was removed, need to refactor into one method
        for($i = 0; $i < count($array_row) - 1; $i++){
            if(!isIncreasingOrDecreasingWithinRange($array_row[$i], $array_row[$i + 1]) || $array_row[$i] == $array_row[$i + 1]){
                array_splice($array_row, $i, 1);
                print_r($array_row);
                if($i - 1 >= 0){
                    if(!isIncreasingOrDecreasingWithinRange($array_row[$i - 1], $array_row[$i]) || $array_row[$i] == $array_row[$i - 1]){
                        continue 2;
                    }
                } else {
                    if(!isIncreasingOrDecreasingWithinRange($array_row[0], $array_row[1]) || $array_row[0] == $array_row[1]){
                        continue 2;
                    }
                }
            }
        };
        print("safe up \n");
        $safe++;
    }
    
}
print($safe);

// 693 is too high

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