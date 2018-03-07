# StdLib

An opinionated StdLib for PHP.

# Why?

Because.

# Seriously?

This is just an experiment. What if PHPs arrays were, well, just arrays, or
strings could be fully object oriented. This is an attempt to scratch this itch.

# StdArray

This class aims to make the array operations in PHP a litte bit more fun.
Instead of writing and joining the results from about 80 array functions
you get a nice fluent interface that just works with arrays and has a near
php native performance.

```php
use StdLib\StdArray;

// Map/Reduce
$array = [1, 2, 3, 4, 5];
$result = (new StdArray($array))
  ->map(function($item) {
    return $item * 2;
  })
  ->filter(function($item) {
    return $item < 5;
  })
  ->reduce(function($carry, $item) {
    return $carry + $item;
  }, 0);
var_dump($result); // int(6)

// Basic Array operations
$array = [1, 2, 3, 4, 5];
$first = (new StdArray($array))->first();
var_dump($first); // int(1)

$array = [1, 2, 3, 4, 5];
$last = (new StdArray($array))->last();
var_dump($first); // int(5)

$array = [1, 2, 3, 4, 5];
$count = (new StdArray($array))->count();
var_dump($count); // int(5)

$array = [1, null, 3, null, 5];
$compact = (new StdArray($array))->compact()->end();
var_dump($compact);
/*
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(3)
  [2]=>
  int(5)
}
*/

$array = [1, 2, 3, 4, 5];
$all = (new StdArray($array))->all(function($item) {
  return is_int($item);
});
var_dump($all); // bool(true)

$array = [1, 1, 2, 3, 3];
$uniq = (new StdArray([1, 1, 2, 3, 3]))->uniq()->end();
var_dump($uniq);
/*
array(3) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  [2]=>
  int(3)
}
*/

$array = [3, 4, 2, 1, 5];
$sort = (new StdArray($array))->sort()->end();
var_dump($sort);
/*
array(5) {
  [0]=>
  int(1)
  [1]=>
  int(2)
  [2]=>
  int(3)
  [3]=>
  int(4)
  [4]=>
  int(5)
}
*/

$array = [3, 4, 2, 1, 5];
$sort = (new StdArray($array))->sort(function($a, $b) {
  return $a < $b;
})->end();
var_dump($sort);
/*
array(5) {
  [0]=>
  int(5)
  [1]=>
  int(4)
  [2]=>
  int(3)
  [3]=>
  int(2)
  [4]=>
  int(1)
}
*/
```

# Test it

Run composer.

```
docker run --rm -it -v $(pwd):/app composer install
```

Execute tests.

```
docker run --rm -it -v $(pwd):/app -w /app php:7.1-cli php vendor/bin/phpunit tests/StdArrayTest.php --colors
```
