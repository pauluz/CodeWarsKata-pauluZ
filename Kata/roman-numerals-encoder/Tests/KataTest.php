<?php
use function Pauluz\CodeWars\Kata\encoderSolution;

class MyTestEncoderCases extends PHPUnit_Framework_TestCase
{
  // static tests
  public function test_static_operations()
  {
    $this->assertEquals("M", encoderSolution(1000));
    $this->assertEquals("IV", encoderSolution(4));
    $this->assertEquals("I", encoderSolution(1));
    $this->assertEquals("MCMXC", encoderSolution(1990));
    $this->assertEquals("MMVIII", encoderSolution(2008));
  }

  // random tests
  public function test_random_operations()
  {
    for ($i = 0; $i < 100; $i++) {
      $n = mt_rand(0, 25000);
      $this->assertEquals($this->get_result($n), encoderSolution($n));
    }
  }

  // solution
  private function get_result($number)
  {
    $roman =
      ["M" => 1000,
        "CM" => 900,
        "D" => 500,
        "CD" => 400,
        "C" => 100,
        "XC" => 90,
        "L" => 50,
        "XL" => 40,
        "X" => 10,
        "IX" => 9,
        "V" => 5,
        "IV" => 4,
        "I" => 1];

    $ans = "";

    while ($number > 0) {
      foreach ($roman as $key => $num) {
        if ($num <= $number) {
          $ans .= $key;
          $number -= $num;
          break;
        }
      }
    }
    return $ans;
  }
}
