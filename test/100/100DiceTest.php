<?php

namespace Isa\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceCreateObjectTest extends TestCase
{
    public function testCreateDice()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Isa\Dice\Dice", $dice);

        $numbers = $dice->getNumbers();
        $array = array();
        $this->assertEquals($array, $numbers);
    }

    public function testThrowDice()
    {
        $dice = new Dice();
        $dice->throw(2);

        $numbers = $dice->getNumbers();
        $count = count($numbers);
        $exp = 2;
        $this->assertEquals($count, $exp);
    }

    public function testSum()
    {
        $dice = new Dice();
        $dice->throw(2);

        $sum1 = $dice->sum();
        $sum2 = array_sum($dice->getNumbers());
        $this->assertEquals($sum1, $sum2);
    }

    public function testEmptyArray()
    {
        $dice = new Dice();
        $dice->throw(2);

        $dice->emptyArray();
        $numbers = $dice->getNumbers();
        $array = array();
        $this->assertEquals($numbers, $array);
    }

    public function testEmptyCheck()
    {
        $dice = new Dice();

        $res = $dice->check();
        $bool = true;
        $this->assertEquals($res, $bool);
    }
}
