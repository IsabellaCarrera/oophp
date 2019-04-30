<?php
namespace Isa\Handler;

/**
* The dice game 100.
*/

class Handler
{
    private $playerPoints = 0;
    private $computerPoints = 0;
    

    public function savePlayerPoints($points)
    {
        $this->playerPoints += $points;
    }

    public function saveComputerPoints($points)
    {
        $this->computerPoints += $points;
    }

    public function getPlayerPoints()
    {
        return $this->playerPoints;
    }

    public function getComputerPoints()
    {
        return $this->computerPoints;
    }
}
