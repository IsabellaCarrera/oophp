<?php
namespace Isa\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */

    private $number;
    private $tries;
    private $res;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $number = -1, int $tries = 6)
    {
        if ($number == -1) {
            $this->number = rand(1, 100);
        } else {
            $this->number = $number;
        }
        $this->tries = $tries;
    }


    /**
     * Get number of tries left.
     *
     * @return int as number of tries left.
     */
    public function tries(): int
    {
        return $this->tries;
    }

    /**
     * Get res.
     *
     * @return int as res.
     */
    public function res()
    {
        return $this->res;
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number(): int
    {
        return $this->number;
    }



    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    public function makeGuess(int $guess): string
    {
        if (!($guess > 0 && $guess <= 100)) {
            throw new GuessException("Number is out of bounds.");
        }
        $this->tries -= 1;
        if ($this->tries == -1) {
            $this->res = "WRONG, YOU LOST! Press 'Start from beginning' to start a new game.";
        } elseif ($guess === $this->number) {
            $this->res = "CORRECT!!! Press 'Start from beginning' to start a new game.";
        } elseif ($guess < $this->number) {
            $this->res = "TO LOW!";
        } elseif ($guess > $this->number) {
            $this->res = "TO HIGH!";
        }
        return $this->res;
    }
}
