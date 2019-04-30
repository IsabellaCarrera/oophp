<?php
namespace Isa\Dice;

/**
 * The Dice class.
 */
class Dice
{
    /**
    * @var array $numbers Save the dice values in array.
    *
    */
    private $numbers = array();

    /**
    * Throws the dice number times.
    */
    public function throw($number)
    {
        for ($i = 1; $i <= $number; $i++) {
            array_push($this->numbers, rand(1, 6));
        }
    }

    /**
    * Prints the numbers the dice threw.
    */
    public function print()
    {
        foreach ($this->numbers as $number) {
            echo $number . ", ";
        }
    }

    /**
    * Sums up the numbers in array $numbers.
    */
    public function sum()
    {
        return array_sum($this->numbers);
    }

    public function emptyArray()
    {
        $this->numbers = array();
    }

    public function check()
    {
        foreach ($this->numbers as $number) {
            if ($number == 1) {
                return false;
            }
        }
        return true;
    }

    public function getNumbers()
    {
        return $this->numbers;
    }
}
