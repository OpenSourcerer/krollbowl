<?php
use PHPUnit\Framework\TestCase;

require_once("../Score.php");

class ScoreTest extends TestCase
{
     /**
     * @dataProvider framesProvider
     */
    public function testCalculate($expected, $frames)
    {
		$score = new Score($frames);
        $this->assertEquals($expected, $score->calculate());
    }

    public function framesProvider()
    {
        return array(
			"allstrikes" => array(300, array(new Frame(array("X")),new Frame(array("X")),new Frame(array("X")),new Frame(array("X")),new Frame(array("X")),new Frame(array("X")),new Frame(array("X")),new Frame(array("X")),new Frame(array("X")),new Frame(array("X")),new Frame(array("X")),new Frame(array("X")))),
			"ninegutter" => array(90, array(new Frame(array("9", "-")),new Frame(array("9", "-")),new Frame(array("9", "-")),new Frame(array("9", "-")),new Frame(array("9", "-")),new Frame(array("9", "-")),new Frame(array("9", "-")),new Frame(array("9", "-")),new Frame(array("9", "-")),new Frame(array("9", "-")))),
			"fivespare" =>  array(150, array(new Frame(array("5", "/")),new Frame(array("5", "/")),new Frame(array("5", "/")),new Frame(array("5", "/")),new Frame(array("5", "/")),new Frame(array("5", "/")),new Frame(array("5", "/")),new Frame(array("5", "/")),new Frame(array("5", "/")),new Frame(array("5", "/")),new Frame(array("5", "/")),new Frame(array("5")))),
			"fivefour" => array(90, array(new Frame(array("5", "4")),new Frame(array("5", "4")),new Frame(array("5", "4")),new Frame(array("5", "4")),new Frame(array("5", "4")),new Frame(array("5", "4")),new Frame(array("5", "4")),new Frame(array("5", "4")),new Frame(array("5", "4")),new Frame(array("5", "4"))))
		);
    }
}
?>