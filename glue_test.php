<?php

define('AMOUNT', '1000000');

$start = microtime(true);
$str = "";
for ($i = 1; $i < AMOUNT; $i++)
    $str .= $i . ", ";
$res = substr($str, 0, -2);

$finish1 = microtime(true);

$arr = array();
for ($i = 1; $i < AMOUNT; $i++)
    $arr[] = $i;
$res = join(', ', $arr);

$finish2 = microtime(true);

echo "time1: " . ($finish1 - $start) . "\n";
echo "time2: " . ($finish2 - $finish1) . "\n";
