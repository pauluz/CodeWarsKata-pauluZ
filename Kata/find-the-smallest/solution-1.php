<?php
namespace Pauluz\CodeWars\Kata;

function smallest($n)
{
  $out = [$n, 0, 0];

  $length = strlen($n);
  $array = str_split($n);

  foreach ($array as $key => $val) {
    for ($i = 0; $i < $length; $i++) {
      $tmp = $array;
      unset($tmp[$key]);

      array_splice($tmp, $i, 0, $val);

      $number = implode('', $tmp);

      if ($number < $out[0]) {
        $out = [$number, $key, $i];
      }
    }
  }

  return $out;
}
