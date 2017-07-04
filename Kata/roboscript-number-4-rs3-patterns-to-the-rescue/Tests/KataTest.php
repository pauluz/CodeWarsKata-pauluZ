<?php
use function Pauluz\CodeWars\Kata\execute;

class RS3InterpreterTest extends PHPUnit_Framework_TestCase
{
  protected function randomize(array $a)
  {
    for ($i = 0; $i < 2 * count($a); $i++) {
      $v = array_rand($a);
      $w = array_rand($a);
      list($a[$v], $a[$w]) = [$a[$w], $a[$v]];
    }

    return $a;
  }

  public
  function testRS2Only()
  {
    foreach ($this->randomize([
      function () {
        $this->assertEquals("    **   **      *\r\n    **   ***     *\r\n  **** *** **  ***\r\n  *  * *    ** *  \r\n***  ***     ***  ", execute('(F2LF2R)2FRF4L(F2LF2R)2(FRFL)4(F2LF2R)2'));
      },
      function () {
        $this->assertEquals(str_repeat("*", 53), execute("(F13)4"));
      },
      function () {
        $this->assertEquals(str_repeat("*", 61), execute("(F4)15"));
      },
      function () {
        $this->assertEquals(str_repeat("*", 749), execute("((F4)12(F2)10)11"));
      }
    ]) as $assertion) $assertion();
  }

  public
  function testPatternDefinitionsOnly()
  {
    foreach ($this->randomize([
      function () {
        $this->assertEquals('*', execute('p0(F2LF2R)2q'));
      },
      function () {
        $this->assertEquals('*', execute('p312(F2LF2R)2q'));
      },
      function () {
        $this->assertEquals('*', execute('p7F4Rq'));
      },
      function () {
        $this->assertEquals('*', execute('p10F4Lq'));
      },
      function () {
        $this->assertEquals('*', execute('p69F5Lq'));
      },
      function () {
        $this->assertEquals('*', execute('p230F5Rq'));
      },
      function () {
        $this->assertEquals('*', execute('p100867FLF2RF3LF4Rq'));
      },
      function () {
        $this->assertEquals('*', execute('p38942394((FLFR)2F)2q'));
      }
    ]) as $assertion) $assertion();
  }

  public
  function testDefineAndInvoke()
  {
    foreach ($this->randomize([
      function () {
        $this->assertEquals("    *\r\n    *\r\n  ***\r\n  *  \r\n***  ", execute('p0(F2LF2R)2qP0'));
      },
      function () {
        $this->assertEquals("    *\r\n    *\r\n  ***\r\n  *  \r\n***  ", execute('p312(F2LF2R)2qP312'));
      },
      function () {
        $this->assertEquals('*****', execute('p7F4RqP7'));
      },
      function () {
        $this->assertEquals('*****', execute('p10F4LqP10'));
      },
      function () {
        $this->assertEquals('******', execute('p69F5LqP69'));
      },
      function () {
        $this->assertEquals('******', execute('p230F5RqP230'));
      },
      function () {
        $this->assertEquals("    *\r\n    *\r\n    *\r\n    *\r\n ****\r\n *   \r\n**   ", execute('p100867FLF2RF3LF4RqP100867'));
      },
      function () {
        $this->assertEquals("     **\r\n    ** \r\n  ***  \r\n **    \r\n**     ", execute('p38942394((FLFR)2F)2qP38942394'));
      }
    ]) as $assertion) $assertion();
  }

  public
  function testParseOrder()
  {
    foreach ($this->randomize([
      function () {
        $this->assertEquals("    *\r\n    *\r\n  ***\r\n  *  \r\n***  ", execute('P0p0(F2LF2R)2q'));
      },
      function () {
        $this->assertEquals("    *\r\n    *\r\n  ***\r\n  *  \r\n***  ", execute('P312p312(F2LF2R)2q'));
      },
      function () {
        $this->assertEquals('*****', execute('P7p7F4Rq'));
      },
      function () {
        $this->assertEquals('*****', execute('P10p10F4Lq'));
      },
      function () {
        $this->assertEquals('******', execute('P69p69F5Lq'));
      },
      function () {
        $this->assertEquals('******', execute('P230p230F5Rq'));
      },
      function () {
        $this->assertEquals("    *\r\n    *\r\n    *\r\n    *\r\n ****\r\n *   \r\n**   ", execute('P100867p100867FLF2RF3LF4Rq'));
      },
      function () {
        $this->assertEquals("     **\r\n    ** \r\n  ***  \r\n **    \r\n**     ", execute('P38942394p38942394((FLFR)2F)2q'));
      }
    ]) as $assertion) $assertion();
  }

  public
  function testMixedCodeBasic()
  {
    foreach ($this->randomize([
      function () {
        $this->assertEquals("       *\r\n       *\r\n       *\r\n       *\r\n     ***\r\n     *  \r\n******  ", execute('F3P0Lp0(F2LF2R)2qF2'));
      },
      function () {
        $this->assertEquals("    **   **      *\r\n    **   ***     *\r\n  **** *** **  ***\r\n  *  * *    ** *  \r\n***  ***     ***  ", execute('p13(F2LF2R)2qP13FRF4LP13(FRFL)4P13'));
      },
      function () {
        $this->assertEquals("    *\r\n    *\r\n    *\r\n    *\r\n*****", execute('P33Fp33F4LqF3'));
      },
      function () {
        $this->assertEquals("*****\r\n    *\r\n    *\r\n    *\r\n    *\r\n    *\r\n    *", execute('P19F4p19F4RqF2'));
      },
      function () {
        $this->assertEquals("     ****\r\n     *   \r\n     *   \r\n******   ", execute('p996F5LqP996F3RF3'));
      },
      function () {
        $this->assertEquals("******\r\n     *\r\n     *\r\n     *\r\n  ****", execute('P0F4RF3p0F5Rq'));
      },
      function () {
        $this->assertEquals("*****\r\n**   \r\n **  \r\n  *  \r\n  ** \r\n   **\r\n ****", execute('F3Lp5((FLFR)2F)2qP5RF4'));
      }
    ]) as $assertion) $assertion();
  }

  public
  function testMultipleInvocations()
  {
    foreach ($this->randomize([
      function () {
        $this->assertEquals("      *\r\n      *\r\n    ***\r\n    *  \r\n  ***  \r\n  *    \r\n***    ", execute('(P0)2p0F2LF2RqP0'));
      },
      function () {
        $this->assertEquals("*****\r\n*   *\r\n*   *\r\n*   *\r\n*****", execute('p0F4Lq(P0)4'));
      },
      function () {
        $this->assertEquals("*****\r\n*   *\r\n*   *\r\n*   *\r\n*****", execute('p1000FFFFRq(P1000)4'));
      },
      function () {
        $this->assertEquals("******\r\n*    *\r\n******", execute('P6p6F5LqF2LP6F2L'));
      },
      function () {
        $this->assertEquals("****\r\n*  *\r\n*  *\r\n*  *\r\n*  *\r\n****", execute('p0F5Rq(F3RP0)2'));
      },
      function () {
        $this->assertEquals("     *******\r\n    **   ** \r\n  ***  ***  \r\n **   **    \r\n**   **     ", execute('p3((FLFR)2F)2qP3F5L2P3'));
      }
    ]) as $assertion) $assertion();
  }

  /**
   * expectedException ParseError
   */
  public
  function testInvalidInvocation1()
  {
    //execute('p0(F2LF2R)2qP1');
  }

  /**
   * expectedException ParseError
   */
  public
  function testInvalidInvocation2()
  {
    //execute('P0p312(F2LF2R)2q');
  }

  /**
   * expectedException ParseError
   */
  public
  function testInvalidInvocation3()
  {
    //execute('P312');
  }

  /**
   * expectedException ParseError
   */
  public
  function testInvalidInvocation4()
  {
    //execute('P7P7p7F5LF6RF145q(P6)33P7');
  }

  /**
   * expectedException ParseError
   */
  public
  function testInvalidInvocation5()
  {
    //execute('(P999)17p999F3R2F6L3FFFRFq(P999)1024P99973');
  }

  public
  function testMultiplePatternDefinitions()
  {
    foreach ($this->randomize([
      function () {
        $this->assertEquals("  ***\r\n  * *\r\n*** *", execute('P1P2p1F2Lqp2F2RqP2P1'));
      },
      function () {
        $this->assertEquals("  *** *** ***\r\n  * * * * * *\r\n*** *** *** *", execute('p1F2Lqp2F2Rqp3P1(P2)2P1q(P3)3'));
      },
      function () {
        $this->assertEquals("****\r\n*  *\r\n*  *\r\n*  *\r\n*  *\r\n*  *\r\n*  *\r\n****", execute('p34F7Lqp5F3Lq(P5P34)2'));
      },
      function () {
        $this->assertEquals("****\r\n*  *\r\n* **\r\n*   \r\n*   ", execute('P1P3p1FLqp3F2Lqp0F3Lqp2F4LqP0P2'));
      },
      function () {
        $this->assertEquals("****  \r\n*  *  \r\n* **  \r\n*     \r\n******", execute('p0FLqp1FP0qp2FP1qp3FP2qp4FP3qP0P1P2P3P4'));
      }
    ]) as $assertion) $assertion();
  }

  /**
   * expectedException ParseError
   */
  public
  function testInvalidDefinitionOverwrite()
  {
    //execute('p1F2Lqp1(F3LF4R)5qp2F2Rqp3P1(P2)2P1q(P3)3');
  }

  /**
   * expectedException ParseError
   */
  public
  function testInfiniteRecursion()
  {
    //execute('p1F2RP1F2LqP1');
  }

  /**
   * expectedException ParseError
   */
  public
  function testInfiniteMutualRecursion()
  {
    //execute('p1F2LP2qp2F2RP1qP1');
  }
}