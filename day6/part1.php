<?php

include('input.php');

// If there is something directly in front of you, turn right 90 degrees.
// Otherwise, take a step forward.

$input = str_replace("\r", "", $input);
$exploded_array = explode("\n", trim($input));
foreach($exploded_array as $row_key => $row) // x
{
    $exploded_array[$row_key] = str_split($row); // y
}

// find the location of the guard 
// while loop maybe
    // move the guard forward in the grid, if it hits an object, turn right 
    // change each position the guard visits to be an "0" if it hasn't been visited before, keep a count of all "0"s
    // if the guard moves off the map, exit and return count of "0"s

// print_r($exploded_array);
print_r(guardLocation($exploded_array));

$visited_positions = 0;
$in_bounds = true;

$guard_location = guardLocation($exploded_array);
while($in_bounds){
    // todo: these could be moved into a method as well maybe, otherwise logic will be repeated
    if($guard_location === "^"){ // move up - smaller numbers in row

    } else if($guard_location === "V"){ // move down - larger numbers in row

    } else if if($guard_location === "<"){ // move left - smaller numbers in column

    } else if($guard_location === ">"){ // move right - larger numbers in column

    }
}

function shouldTurn($next_x, $next_y){
    if($exploded_array[$next_x, $next_y]){
        return true;
    }
    return false;
}

function guardLocation($exploded_array)
{
   foreach($exploded_array as $row_key => $row)
   {
        foreach($row as $column_key => $column){ // x
            if($column === "^" || $column === "V" || $column === "<" || $column === ">"){
                return [$column_key, $row_key]; // (x, y)
            }
        }
   }
}