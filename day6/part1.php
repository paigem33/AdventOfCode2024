<?php

include('input.php');

// If there is something directly in front of you, turn right 90 degrees.
// Otherwise, take a step forward.

$input = str_replace("\r", "", $input);
$exploded_array = explode("\n", trim($input));
foreach($exploded_array as $row_key => $row)
{
    $exploded_array[$row_key] = str_split($row);
}

print_r(guardLocation($exploded_array));

$visited_positions = 0;
$in_bounds = true;

$guard_location = guardLocation($exploded_array);
$guard = "^";
while($in_bounds){
    if(isset($exploded_array[$guard_location[0]][$guard_location[1]])){
        if($guard === "^"){ // move up - smaller numbers in row
            if(shouldTurn($guard_location[0] - 1, $guard_location[1])){
                $guard = ">";
            } else {
                // if the current location hasn't been visited, update and count
                if($exploded_array[$guard_location[0]][$guard_location[1]] != "0"){
                    $exploded_array[$guard_location[0]][$guard_location[1]] = "0";
                    $visited_positions++;
                }
                $guard_location[0] = $guard_location[0] - 1;
            }
        } else if($guard === "V"){ // move down - larger numbers in row
            if(shouldTurn($guard_location[0] + 1, $guard_location[1])){
                $guard = "<";
            } else {
                // if the current location hasn't been visited, update and count
                if($exploded_array[$guard_location[0]][$guard_location[1]] != "0"){
                    $exploded_array[$guard_location[0]][$guard_location[1]] = "0";
                    $visited_positions++;
                }
                $guard_location[0] = $guard_location[0] + 1;
            }
        } else if($guard === "<"){ // move left - smaller numbers in column
            if(shouldTurn($guard_location[0], $guard_location[1] - 1)){
                $guard = "^";
            } else {
                // if the current location hasn't been visited, update and count
                if($exploded_array[$guard_location[0]][$guard_location[1]] != "0"){
                    $exploded_array[$guard_location[0]][$guard_location[1]] = "0";
                    $visited_positions++;
                }
                $guard_location[1] = $guard_location[1] - 1;
            }
        } else if($guard === ">"){ // move right - larger numbers in column
            if(shouldTurn($guard_location[0], $guard_location[1] + 1)){
                $guard = "V";
            } else {
                // if the current location hasn't been visited, update and count
                if($exploded_array[$guard_location[0]][$guard_location[1]] != "0"){
                    $exploded_array[$guard_location[0]][$guard_location[1]] = "0";
                    $visited_positions++;
                }
                $guard_location[1] = $guard_location[1] + 1;
            }
        }
    } else {
        $in_bounds = false;
    }
}
print($visited_positions);

function shouldTurn($next_x, $next_y){
    global $exploded_array;
    if(isset($exploded_array[$next_x][$next_y]) && $exploded_array[$next_x][$next_y] === "#"){
        return true;
    }
    return false;
}

function guardLocation($exploded_array)
{
   foreach($exploded_array as $row_key => $row)
   {
        foreach($row as $column_key => $column){
            if($column === "^"){
                return [$row_key, $column_key]; // (y, x)
            }
        }
   }
}