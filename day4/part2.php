<?php

include('input.php');

$input = str_replace("\r", "", $input);
$exploded_array = explode("\n", trim($input));

$input_array = [];

foreach($exploded_array as $index => $row){
    array_push($input_array, str_split($row));
}

$max_y = count($input_array);
$max_x = count($input_array[0]);

$count = 0;

$directions = [
    "NW" => [1, -1],  "NE" => [1, 1],
    "SE" => [-1, 1], "SW" => [-1, -1]
];

$valid_orders = [
    'MMSS', 'MSSM', 'SSMM', 'SMMS'
];

foreach($input_array as $row_index => $row) { // y
    foreach($row as $column_index => $column) { // x

        if ($column == "A") { 
            $built_word = [];
            foreach($directions as $direction => [$dy, $dx]){
                array_push($built_word, letterAt($column_index + $dx, $row_index + $dy));
            }
            if(count($built_word) == 4 && in_array(implode($built_word), $valid_orders)){
                $count++;
            }
        }
    }
}

print($count); // 1854

// order to check: NW NE SE SW
// allowed patterns: 'MMSS' 'MSSM' 'SSMM' 'SMMS'

function isSafe($x, $y){
    global $max_x, $max_y;
    return ($x >= 0 && $x < $max_x) && ($y >= 0 && $y < $max_y);
}

function letterAt($x, $y){ 
    
    global $input_array;

    if(isSafe($y, $x)){
        return $input_array[$y][$x];
    } else {
        return "";
    }
    

}