<?php 

$input = "
7 6 4 2 1
1 2 7 8 9
9 7 6 2 1
8 6 4 4 1
1 3 6 7 9
1 3 2 4 5";

$input = str_replace("\r", "", $input);
$input_array = explode("\n", trim($input));