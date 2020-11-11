<?php

function bin_searchByKey($file, $targetValue) {
    $openfile = fopen("$file", "r");
    $i = 0;
    while (feof($openfile) != true) {
        $readstr = fgets($openfile);
        echo "<pre>";//echo $readstr;
        $splitstr[] = explode("\t", $readstr);
        //print_r($splitstr);
        $arr_key[] = $splitstr[$i][0];
        $arr_val[] = $splitstr[$i][1];
        $i++;
        $arr_result = array_combine($arr_key, $arr_val);
    }
    array_pop($arr_result); array_pop($arr_result);
    //echo "ARR_KEY";
    //print_r($arr_key);
    //echo "ARR_VAL";
    //print_r($arr_val);
    echo "ARR_RESULT<br>";
    print_r($arr_result);
    $left = 0;
    $right = count($arr_result) - 1;
    $keys = array_keys($arr_result);
    //print_r($keys);
    while ($left <= $right) {
        $mid = floor(($left + $right) / 2);
        $search = strnatcmp($keys[$mid], $targetValue);
        if ($search > 0) {
            $right = $mid - 1;
        } elseif ($search < 0) {
            $left = $mid + 1;
        } else {
            echo "Искомый ключ - $targetValue<br>Искомое значение ключа - ";
            return $arr_result[$keys[$mid]];
        }
    }
    return "undefined";
}
$file = './Keynumbers.txt';
$targetValue = 'ключ6';
echo bin_searchByKey($file, $targetValue);