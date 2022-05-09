<?php

namespace Code;

class Game
{
    /**
     * @param int $firstInFrame
     * @return bool
     */
    private function isSpare(int $firstInFrame): bool
    {
        return $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1] == 10;
    }

    /**
     * @param int $firstInFrame
     * @return bool
     */
    private function isStrike(int $firstInFrame): bool
    {
        return $this->rolls[$firstInFrame] == 10;
    }

    private $rolls = [20];
    private int $currentRoll = 0;

    public function roll(int $pins)
    {
        $this->rolls[$this->currentRoll++] = $pins;
    }

    public function score()
    {
        $score = 0;
        $firstInFrame = 0;
        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->isStrike($firstInFrame)) {
                $score +=  10 + $this->rolls[$firstInFrame + 1] + $this->rolls[$firstInFrame + 2];
                $firstInFrame++;
            } elseif ($this->isSpare($firstInFrame)) {
                $score += 10 + $this->rolls[$firstInFrame + 2];
                $firstInFrame += 2;
            } else {
                $score += $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1];
                $firstInFrame += 2;
            }
        }
        return $score;
    }
}
$cout = new Game();
$cout->roll(104);
echo $cout->score($score = 10, $firstInFrame = 30);