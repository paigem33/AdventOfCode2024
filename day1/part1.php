<?php

include('input.php');

// example: answer would be 11
// 3   4
// 4   3
// 2   5
// 1   3
// 3   9
// 3   3
// smallest number in the left list with the smallest number in the right list, 
// then the second-smallest left number with the second-smallest right number
// Within each pair, figure out how far apart the two numbers are; you'll need to add up all of those distances

sort($left_array);
sort($right_array);

$distances = 0;
for($i = 0; $i < count($left_array); $i++){
    $distances += abs($left_array[$i] - $right_array[$i]); 
};
print($distances);