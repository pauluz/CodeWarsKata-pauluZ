<?php
namespace Pauluz\CodeWars\Kata;

function multiply(string $a, string $b) {
  if (empty($a) || empty($b)) {
    return '0';
  }

  $a = array_reverse(str_split($a));
  $b = array_reverse(str_split($b));

  $out = [0];
  for ($i = 0, $max_a = count($a); $i < $max_a; $i++) {
    $m = 0;
    for ($j = 0, $max_b = count($b); $j < $max_b; $j++) {
      $w = $a[$i] * $b[$j] + $m;
      $w = strrev($w);

      $out[$i + $j] = isset($out[$i + $j]) ? ($out[$i + $j] + $w{0}) : $w{0};
      if ($out[$i + $j] > 9) {
        $out[$i + $j] = $out[$i + $j] % 10;
        $out[$i + $j + 1] = isset($out[$i + $j + 1]) ? ($out[$i + $j + 1] + 1) : 1;
      }
      $m = isset($w{1}) ? $w{1} : 0;
    }

    if ($m > 0) {
      $out[$i + $j] = isset($out[$i + $j]) ? ($out[$i + $j] + $m) : $m;
    }
  }

  return ltrim(implode('', array_reverse($out)), '0');
}
