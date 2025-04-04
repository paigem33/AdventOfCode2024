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

$word = "XMAS";
$count = 0;

$directions = [
    "SW" => [-1, -1], "S" => [-1, 0], "SE" => [-1, 1],
    "W"  => [0, -1],  "E" => [0, 1],
    "NW" => [1, -1],  "N" => [1, 0],  "NE" => [1, 1]
];

foreach($input_array as $row_index => $row) { // y
    foreach($row as $column_index => $column) { // x

        if ($column == $word[0]) { // Found an 'X'
            
            foreach ($directions as $direction => [$dy, $dx]) {
                $new_row = $row_index + $dy;
                $new_col = $column_index + $dx;

                // todo: see if this can be refactored to use the recursive method for $word[1]
                if (isSafe($new_row, $new_col) && $input_array[$new_row][$new_col] == $word[1]) {
                    $found_word = foundWord(2, $new_col, $new_row, $direction);
                    if ($found_word) {
                        $count++;
                    }
                }
            }
        }
    }
}

print($count); // 2557

function isSafe($x, $y){
    global $max_x, $max_y;
    return ($x >= 0 && $x < $max_x) && ($y >= 0 && $y < $max_y);
}

function foundWord($letter_index, $x, $y, $direction){ 
    
    global $word, $directions, $input_array;

    $new_col = $x + $directions[$direction][1];
    $new_row = $y + $directions[$direction][0];

    if(isSafe($new_row, $new_col) && $input_array[$new_row][$new_col] == $word[$letter_index]){
        // found the last index, return true
        if($letter_index == strlen($word) - 1){
            // it is getting to here
        }
        // move to next index
        return foundWord($letter_index + 1, $new_col, $new_row, $direction);
    } else {
        // next letter was not correct
        return false;
    }
    

}