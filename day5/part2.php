<?php

include('input.php');

$rules_array = explode("\n", $rules);
foreach($rules_array as $index => $rule){
    $rules_array[$index] = $rule;
}

$updates_array = explode("\n", $updates);
foreach($updates_array as $index => $value){
    $updates_array[$index] = explode(",", $value);
}

$total = 0;
foreach($updates_array as $update){
    $original = $update;
    usort($update, "compare");
    if($original != $update){
        $total += getMiddle($update);
    }
}
print($total);

function compare($a, $b){
    global $rules_array;
    if(in_array($b . "|" . $a, $rules_array)){
        return 1;
    } else if(in_array($a . "|" . $b, $rules_array)){
        return -1;
    } else {
        return 0;
    }
}

function getMiddle($array){
    $middle_index = floor(count($array) / 2);
    return $array[$middle_index];
}