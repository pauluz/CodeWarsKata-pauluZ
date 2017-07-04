<?php
namespace Pauluz\CodeWars\Kata;

function decoderSolution($roman)
{
  $roman = strrev($roman);
  $number = 0;

  // reversed roman strings
  $r[0] = array_reverse([1 => 'I', 'II', 'III', 'VI', 'V', 'IV', 'IIV', 'IIIV', 'XI'], true);
  $r[1] = array_reverse([1 => 'X', 'XX', 'XXX', 'LX', 'L', 'XL', 'XXL', 'XXXL', 'CX'], true);
  $r[2] = array_reverse([1 => 'C', 'CC', 'CCC', 'DC', 'D', 'CD', 'CCD', 'CCCD', 'MC'], true);

  foreach ($r as $pow => $rome) {
    foreach ($rome as $k => $v) {
      if (substr($roman, 0, strlen($v)) == $v) {
        // crap !!! but working
        if (($k == 5) && (strlen($roman) > 1) && ($roman{1} == $rome[1])) {
          continue;
        }

        $number += pow(10, $pow) * $k;
        $roman = substr($roman, strlen($v));
        break;
      }
    }
  }
  if (!empty($roman)) {
    $number += 1000 * strlen($roman);
  }

  return $number;
}