<?php
use function Pauluz\CodeWars\Kata\multiply;

class MultiplyStringsTest extends PHPUnit_Framework_TestCase
{
  public function testSimpleExamples()
  {
    $this->assertEquals("6", multiply("2", "3"));
    $this->assertEquals("2070", multiply("30", "69"));
    $this->assertEquals("935", multiply("11", "85"));
  }

  public function testCornerExamples()
  {
    $this->assertEquals("0", multiply("2", "0"));
    $this->assertEquals("0", multiply("0", "30"));
    $this->assertEquals("3", multiply("0000001", "3"));
    $this->assertEquals("3027", multiply("1009", "03"));
  }

  public function testBigExamples() {
    $this->assertEquals("5619135910", multiply("98765", "56894"));
    $this->assertEquals("2830869077153280552556547081187254342445169156730", multiply("1020303004875647366210", "2774537626200857473632627613"));
    $this->assertEquals("444625839871840560024489175424316205566214109298", multiply("58608473622772837728372827", "7586374672263726736374"));
    $this->assertEquals("81129638414606663681390495662081", multiply("9007199254740991", "9007199254740991"));
  }
  public function testFixed() {
    $this->assertEquals("193228801196767580936937025179030242333589969343595453380648878181298632138525604729517840510039331578252599113191277829", multiply("823094582094385190384102934810293481029348123094818923749817", "234758927345982475298347523984572983472398457293847594193837"));
    $this->assertEquals("231906850957336251478991186749656947273668952935732312056617840392053573968250329123967229808683079035824473891688251610", multiply("234859234758913759182357398457398474598237459823745928347538", "987429134712934876249385134781395873198472398562384958739845"));
    $this->assertEquals("284898195819746508308601272526843276932725891934702757921192020155666470878325339438152527308303674417037959666558345676", multiply("854694587458967459867923420398420394845873945734985374844444", "333333333333439439483948394839834938493843948394839432322229"));
    $this->assertEquals("309764309294970369158202226146309759616554024914566927342293185187019287979125791001525185185160758579124577351091024356", multiply('666666665656566666666565656666666656565666666665656566666666', '464646464646464644646464646464646464646464646463463463463466'));
    $this->assertEquals("825237806451593565479540372134946155438918929176593465466377189876140064578697720538106222103669673453926917713105695761983364398691630451089031488925855360833239652072136952127779284221960464892396337248321438942716276105221888865469319482", multiply("987429134712934876249385134781395873198472398562384958739845234859234758913759182357398457398474598237459823745928347538", "835743829547328954732895474893754893753281957319857432958432548937859483265893274891378593187431583942678439217431924789"));
  }
}
