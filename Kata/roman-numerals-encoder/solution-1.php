<?php
namespace Pauluz\CodeWars\Kata;

function encoderSolution($number)
{
  $d[0] = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX'];
  $d[1] = [1 => 'X', 'XX', 'XXX', 'XL', 'L', 'LX', 'LXX', 'LXXX', 'XC'];
  $d[2] = [1 => 'C', 'CC', 'CCC', 'CD', 'D', 'DC', 'DCC', 'DCCC', 'CM'];

  $out = '';
  $n = array_reverse(str_split($number));
  foreach ($n as $k => $v) {
    if ($k == 3) {
      $out = str_repeat('M', substr($number, 0, -3)) . $out;
      break;
    }
    if ($v == 0) {
      continue;
    }
    $out = $d[$k][$v] . $out;
  }

  return $out;
}
