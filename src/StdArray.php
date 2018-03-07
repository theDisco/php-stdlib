<?php

namespace StdLib;

class StdArray 
{
  private $items;

  public function __construct(array $items)
  {
    $this->items = $items;
  }

  public function map(\Closure $callback): self
  {
    $this->items = array_map($callback, $this->items);
    return $this;
  }

  public function filter(\Closure $callback): self
  {
    $this->items = array_filter($this->items, $callback);
    return $this;
  }

  public function reduce(\Closure $callback, $initial = null)
  {
    return array_reduce($this->items, $callback, $initial);
  }

  public function compact(): self
  {
    $this->items = array_values(
      array_filter($this->items, function($el) {
        return !is_null($el);
      })
    );
    return $this;
  }

  public function uniq(): self
  {
    $this->items = array_values(array_unique($this->items));
    return $this;
  }

  public function sort(\Closure $callback = null): self
  {
    if ($callback) {
      usort($this->items, $callback);
    } else {
      sort($this->items);
    }
    return $this;
  }

  public function first()
  {
    return array_shift(array_slice($this->items, 0, 1));
  }

  public function last()
  {
    return array_shift(array_slice($this->items, -1, 1));
  }

  public function end(): array
  {
    return $this->items;
  }

  public function items(): \Generator
  {
    foreach ($this->items as $item) {
      yield $item;
    }
  }

  public function count(): int
  {
    return count($this->items);
  }

  public function all(\Closure $callback): bool
  {
    foreach ($this->items() as $item) {
      if (!$callback($item)) {
        return false;
      }
    }

    return true;
  }
}
