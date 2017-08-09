<?php
use function Pauluz\CodeWars\Kata\find_uniq;

class FindUniqTest extends PHPUnit_Framework_TestCase
{
// PHPUnit Test Examples:
// TODO: Replace examples and use TDD development by writing your own tests
  // test function names should start with "test"
  public function testSampleUnique() {
    return;
    $this->assertEquals('BbBb', find_uniq([ 'Aa', 'aaa', 'aaaaa', 'BbBb', 'Aaaa', 'AaAaAa', 'a' ]));
    $this->assertEquals('foo', find_uniq([ 'abc', 'acb', 'bac', 'foo', 'bca', 'cab', 'cba' ]));
    $this->assertEquals('victor', find_uniq([ 'silvia', 'vasili', 'victor' ]));
    $this->assertEquals('Harry Potter', find_uniq([ 'Tom Marvolo Riddle', 'I am Lord Voldemort', 'Harry Potter' ]));
  }
}
