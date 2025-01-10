<?php

include('input.php');

// example: answer would be 31
// 3   4
// 4   3
// 2   5
// 1   3
// 3   9
// 3   3
// for each number in left list, multiply it by the number of times it occurs in right list
// add up that output and return for each left value

$right_array = array_count_values($right_array);
$distances = 0;
foreach($left_array as $value){
    if(array_key_exists($value, $right_array)){
        $distances += abs($value * $right_array[$value]); 
    }
}

print($distances);