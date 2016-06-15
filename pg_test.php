<?php
/**
 * Created by PhpStorm.
 * User: soms
 * Date: 15.06.16
 * Time: 10:48
 */

require ('classes/db.php');

define('AMOUNT', 10000);

$start = microtime(true);

for ($i = 0; $i < AMOUNT; $i++)
    if (($res = $db->register_user('user_' . $i, 'user_' . $i)) < 0) {
        echo "Couldn't register user user_" . $i . " with result " . $res . "\n";
        break;
    }

$finish = microtime(true);

echo "Result: " . ($finish - $start) . "\n";
