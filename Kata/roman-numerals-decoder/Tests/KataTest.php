<?php
use function Pauluz\CodeWars\Kata\decoderSolution;

class MyTestDecoderCases extends PHPUnit_Framework_TestCase
{
  private $test = [
    'simple' => [
      'MM' => 2000,
      'MDC' => 1600,
      'L' => 50,
      'XL' => 40,
      'XC' => 90,
      'XCV' => 95,
      'XXI' => 21,
      'IV' => 4,
      'III' => 3,
      '' => 0,
    ],

    'more_complex' => [
      'MCMLIV' => 1954,
      'MDCXLVII' => 1647,
      'CDXCIV' => 494,
      'MMXVII' => 2017,
      'MMVIII' => 2008,
      'MDCLXVI' => 1666,
      'MCCCXXXVII' => 1337,
      'XLII' => 42,
    ],
  ];

  private function revTest($expected, $roman)
  {
    //print_r('\'' . $roman . '\' should be ' . $expected . PHP_EOL);
    $this->assertEquals($expected, decoderSolution($roman));
  }

  public function testSimple()
  {
    foreach ($this->test['simple'] as $roman => $expected) {
      $this->revTest($expected, $roman);
    };
  }

  public function testMoreComplex()
  {
    foreach ($this->test['more_complex'] as $roman => $expected) {
      $this->revTest($expected, $roman);
    };
  }
}
