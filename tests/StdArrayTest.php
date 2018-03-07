<?php

use StdLib\StdArray;
use PHPUnit\Framework\TestCase;

class StdArrayTest extends TestCase
{
  public function testMap()
  {
    $result = (new StdArray([1, 2, 3]))->map(function($item) {
      return $item * 2;
    });
    $this->assertEquals([2, 4, 6], $result->end());
  }

  public function testFilter()
  {
    $result = (new StdArray([1, 2, 3]))->filter(function($item) {
      return $item < 2;
    });
    $this->assertEquals([1], $result->end());
  }

  public function testReduce()
  {
    $result = (new StdArray([1, 2, 3]))->reduce(function($carry, $item) {
      return $carry + $item;
    }, 0);
    $this->assertEquals(6, $result);
  }

  public function testCompact()
  {
    $result = (new StdArray([1, null, 2, 3, null]))->compact();
    $this->assertEquals([1, 2, 3], $result->end());
  }

  public function testUniq()
  {
    $result = (new StdArray([1, 1, 2, 3, 3]))->uniq();
    $this->assertEquals([1, 2, 3], $result->end());
  }

  public function testSortWithoutCallback()
  {
    $result = (new StdArray([3, 4, 2, 1, 5]))->sort();
    $this->assertEquals([1, 2, 3, 4, 5], $result->end());
  }

  public function testSortWithCallback()
  {
    $result = (new StdArray([3, 4, 2, 1, 5]))->sort(function($a, $b) {
      return $a < $b;
    });
    $this->assertEquals([5, 4, 3, 2, 1], $result->end());
  }

  public function testFirst()
  {
    $result = (new StdArray([1, 2, 3]))->first();
    $this->assertEquals(1, $result);
  }

  public function testFirstWithEmptyArray()
  {
    $result = (new StdArray([]))->first();
    $this->assertEquals(null, $result);
  }

  public function testLast()
  {
    $result = (new StdArray([1, 2, 3]))->last();
    $this->assertEquals(3, $result);
  }

  public function testLastWithEmptyArray()
  {
    $result = (new StdArray([]))->last();
    $this->assertEquals(null, $result);
  }

  public function testCount()
  {
    $result = (new StdArray([1, 2, 3]))->count();
    $this->assertEquals(3, $result);
  }

  public function testAll()
  {
    $result = (new StdArray([1, 2, 3]))->all(function($item) {
      return is_int($item);
    });
    $this->assertTrue($result);
  }

  public function testAllNotPassing()
  {
    $result = (new StdArray([1, 2, '3']))->all(function($item) {
      return is_int($item);
    });
    $this->assertFalse($result);
  }

  public function testItems()
  {
    $result = (new StdArray([1, 2, '3']))->items();
    $this->assertEquals(1, $result->current());
  }
}
