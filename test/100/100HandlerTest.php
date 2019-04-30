<?php

namespace Isa\Handler;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */

class HandlerCreateObjectTest extends TestCase
{
    public function testHandlerCero()
    {
        $handler = new Handler();
        $this->assertInstanceOf("\Isa\Handler\Handler", $handler);

        $playerPoints1 = $handler->getPlayerPoints();
        $playerPoints2 = 0;
        $this->assertEquals($playerPoints1, $playerPoints2);

        $computerPoints1 = $handler->getComputerPoints();
        $computerPoints2 = 0;
        $this->assertEquals($computerPoints1, $computerPoints2);
    }

    public function testHandlerSavePlayer()
    {
        $handler = new Handler();
        $handler->savePlayerPoints(14);

        $points1 = $handler->getPlayerPoints();
        $points2 = 14;
        $this->assertEquals($points1, $points2);
    }

    public function testHandlerSaveComputer()
    {
        $handler = new Handler();
        $handler->saveComputerPoints(27);

        $points1 = $handler->getComputerPoints();
        $points2 = 27;
        $this->assertEquals($points1, $points2);
    }
}
