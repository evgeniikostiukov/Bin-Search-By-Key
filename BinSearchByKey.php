<?php


function createFile($fileName, $count)
{
    $file = fopen($fileName, "w");
    for ($i = 0; $i < $count; $i++) {
        fwrite($file, "ключ" . $i . "\t" . "значение" . $i . "\x0A");
    }
}


function runTime($time = false)
{
    return $time === false ? microtime(true) : round(microtime(true) - $time, 3);
}

function bin_searchByKey($file, $targetValue)
{
    $openfile = new SplFileObject($file);
    $left = 0;
    $right = count(file($file)) - 1;
    while ($left <= $right) {
        $mid = floor(($left + $right) / 2);
        $openfile->seek($mid);
        $current_str = explode("\t", $openfile->current());
        $search = strnatcmp($current_str[0], $targetValue);
        if ($search > 0) {
            $right = $mid - 1;
        } elseif ($search < 0) {
            $left = $mid + 1;
        } else {
            echo "Искомый ключ - $targetValue<br>Искомое значение ключа - ";
            return $current_str[1];
        }
    }
    return "undefined";
}

//createFile("Keynumbers.txt", 2000000);
$file = './Keynubmers.txt';
$targetValue = 'ключ3';
$time = runTime();
echo bin_searchByKey($file, $targetValue);
$time = runTime($time);
echo "<br>" . $time . " сек.<br>";
echo round(memory_get_usage() / 1024, 2) . " Кб.";
