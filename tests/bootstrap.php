
<?php

require_once __DIR__ . '/../vendor/autoload.php';

use StdLib\StdArray;
$array = [3, 4, 2, 1, 5];
$sort = (new StdArray($array))->sort()->end();
var_dump($sort);

$array = [3, 4, 2, 1, 5];
$sort = (new StdArray($array))->sort(function($a, $b) {
  return $a < $b;
})->end();
var_dump($sort);
