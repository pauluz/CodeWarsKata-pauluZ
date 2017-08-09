<?php
namespace Pauluz\CodeWars\Kata;

// code by pZ
function find_uniq($a)
{
  $arr = array_map(function($p) { return array_unique(str_split(strtolower($p))); }, $a);

  if (array_diff($arr[0], $arr[1])) {
    if (array_diff($arr[0], $arr[2])) {
      return $a[0];
    } else {
      return $a[1];
    }
  }

  $base = $arr[0];
  
  foreach($arr as $key => $val) {
    $diff = array_diff($val, $base);

    if (! empty($diff)) {
      return $a[$key];
    }
  }
}
