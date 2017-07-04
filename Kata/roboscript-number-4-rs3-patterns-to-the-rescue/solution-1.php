<?php
namespace Pauluz\CodeWars\Kata;

function execute(string $code)
{
  $roboScript = new RoboScriptRS3($code);
  return $roboScript->execute();
}

class RoboScriptRS2
{
  const TOKENS_PATTERN = "/\(|\)\d*|[FLRP\d]+/";
  const COMMANDS_PATTERN = "/[FLR]\d*/";

  public $code;

  public function __construct(string $code)
  {
    $this->code = $code;
  }

  public function execute()
  {
    if (empty($this->code)) return '*';

    // 0 - faces to the right. 1 - faces to the downwards (after R command). etc ...
    $direction = 0;
    $x = 0;
    $y = 0;
    $map = ['*'];

    preg_match_all(self::TOKENS_PATTERN, $this->code, $matches);
    $tokens = $matches[0];

    $this->execute_code($tokens, $map, $x, $y, $direction);

    return implode("\r\n", $map);
  }

  /**
   * recursion function
   */
  public function execute_code(array $code, & $map, & $x, & $y, & $direction)
  {
    $start = 0;
    $open = 0;
    for ($i = 0, $max = count($code); $i < $max; $i++) {
      $commands = $code[$i];

      if ($commands == '(') {
        if ($open == 0) $start = $i;
        $open++;
      } elseif ($commands{0} == ')') {
        $open--;
        if ($open == 0) {
          $repeat = (strlen($commands) > 1) ? substr($commands, 1) : 1;
          for ($r = 0; $r < $repeat; $r++) {
            $this->execute_code(array_slice($code, $start + 1, $i - $start - 1), $map, $x, $y, $direction);
          }
        }
      } elseif ($open == 0) {
        $this->parse($commands, $map, $x, $y, $direction);
      }
    }
  }

  public function parse($code, & $map, & $x, & $y, & $direction)
  {
    preg_match_all(self::COMMANDS_PATTERN, $code, $matches);

    foreach ($matches[0] as $command) {

      $repeat = (strlen($command) > 1) ? substr($command, 1) : 1;

      for ($i = 0; $i < $repeat; $i++) {
        switch ($command{0}) {
          case 'R':
            ($direction == 3) ? ($direction = 0) : $direction++;
            break;
          case 'L':
            ($direction == 0) ? ($direction = 3) : $direction--;
            break;
          case 'F':
            $this->move($map, $x, $y, $direction);
            break;
        }
      }
    }
  }

  protected function move(& $map, & $x, & $y, $direction)
  {
    $space = ' ';

    switch ($direction) {
      case 0:
        $x++;
        if ($x == strlen($map[$y])) {
          foreach ($map as $k => $v) {
            $map[$k] .= $space;
          }
        }
        break;
      case 1:
        $y++;
        if ($y == count($map)) {
          array_push($map, str_repeat($space, strlen($map[0])));
        }
        break;
      case 2:
        if ($x == 0) {
          foreach ($map as $k => $v) {
            $map[$k] = $space . $v;
          }
        } else {
          $x--;
        }
        break;
      case 3:
        if ($y == 0) {
          array_unshift($map, str_repeat($space, strlen($map[0])));
        } else {
          $y--;
        }
        break;
    }
    $map[$y]{$x} = '*';
  }
}

class RoboScriptRS3 extends RoboScriptRS2
{

  const METHODS_PATTERN = "/p(\d+)([FLRP\d\(\)]+)q/";
  const METHODS_EXEC_PATTERN = "/P\d+/";

  public function find_methods(array $matches)
  {
    $methods = [];
    foreach ($matches[0] as $key => $v) {
      if (isset($methods[$matches[1][$key]])) {
        throw new \ParseError();
      }
      $methods[$matches[1][$key]] = $matches[2][$key];
    }

    return $methods;
  }

  public function execute()
  {
    preg_match_all(self::METHODS_PATTERN, $this->code, $matches);

    $methods = $this->find_methods($matches);

    $this->code = preg_replace(self::METHODS_PATTERN, '', $this->code);

    do {
      $replaced_flag = false;
      foreach ($methods as $key => $pattern) {

        preg_match_all(self::METHODS_EXEC_PATTERN, $pattern, $matches);
        $found = $matches[0];

        if (!empty($found)) {

          $found = array_unique($found);
          $this->exec_methods_usort($found);

          foreach ($found as $rep_pattern) {
            $rep_key = substr($rep_pattern, 1);
            if (!isset($methods[$rep_key]) || ($rep_key == $key)) {
              throw new \ParseError();
            }
            $methods[$key] = str_replace($rep_pattern, $methods[$rep_key], $methods[$key]);
          }
          $replaced_flag = true;
        }
      }
    } while ($replaced_flag);

    preg_match_all(self::METHODS_EXEC_PATTERN, $this->code, $matches);
    $found = $matches[0];

    if (!empty($found)) {

      // duplicated code for {$this->code} :(
      $found = array_unique($found);
      $this->exec_methods_usort($found);

      foreach ($found as $rep_pattern) {
        $rep_key = substr($rep_pattern, 1);
        if (!isset($methods[$rep_key])) {
          throw new \ParseError();
        }
        $this->code = str_replace($rep_pattern, $methods[$rep_key], $this->code);
      }
    }

    return parent::execute();
  }

  protected function replace_methods($code)
  {
    // @TODO
  }

  /**
   * for the case when methods have a name 'P7' and 'P71' (for example) - longer first
   */
  private function exec_methods_usort(& $arr)
  {
    usort($arr, function ($a, $b) {
      return (strlen($a) < strlen($b));
    }
    );
  }
}
