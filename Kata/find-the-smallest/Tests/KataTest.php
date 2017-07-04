<?php
use function Pauluz\CodeWars\Kata\smallest;

//class MyTest extends TestCase

class MySmallestTest extends PHPUnit_Framework_TestCase
{
  private function revTest($actual, $expected)
  {
    $this->assertEquals($expected, $actual);
  }

  public function testBasics()
  {
    $this->revTest(smallest(261235), [126235, 2, 0]);
    $this->revTest(smallest(209917), [29917, 0, 1]);
    $this->revTest(smallest(285365), [238565, 3, 1]);
    $this->revTest(smallest(269045), [26945, 3, 0]);
    $this->revTest(smallest(296837), [239687, 4, 1]);

    $this->revTest(smallest(187863002809), [18786300289, 10, 0]);
    $this->revTest(smallest(199819884756), [119989884756, 4, 0]);
    $this->revTest(smallest(94883608842), [9488368842, 6, 0]);
    $this->revTest(smallest(256687587015), [25668758715, 9, 0]);
    $this->revTest(smallest(935855753), [358557539, 0, 8]);
    $this->revTest(smallest(111111111), [111111111, 0, 0]);
  }

  private function _smallestUJ($n)
  {
    $s = strval($n);
    $l = strlen($s);
    $tmp = $s;
    $mem = array(-1, -1, -1);
    for ($i = 0; $i < $l; $i++) {
      $c = $s[$i];
      $str1 = substr($s, 0, $i) . substr($s, $i + 1, $l - $i);
      for ($j = 0; $j < $l; $j++) {
        $str2 = substr($str1, 0, $j) . $c . substr($str1, $j, $l - $j);
        if ($str2 < $tmp) {
          $tmp = $str2;
          $mem[0] = intval($tmp);
          $mem[1] = $i;
          $mem[2] = $j;
        }
      }
    }
    if ($mem[0] === -1) {
      $mem[0] = $n;
      $mem[1] = 0;
      $mem[2] = 0;
    }
    return $mem;
  }

  public function testRandom()
  {
    for ($i = 0; $i < 100; $i++) {
      $n = rand(4000, (int)9007199254740990);
      $sol = $this->_smallestUJ($n);
      $ans = smallest($n);
      //echo $sol."\n";
      $this->revTest($ans, $sol);
    }
  }
}
