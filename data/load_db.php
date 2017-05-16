<?php
/**
 * Created by PhpStorm.
 * User: denny
 * Date: 17/4/10
 * Time: 21:26
 */

$db = new PDO('sqlite:' . realpath(__DIR__) . '/schema.db');
$fh = fopen(__DIR__ . '/schema.sql', 'r');
while ($line = fread($fh, 4096)) {
    $db->exec($line);
}
fclose($fh);