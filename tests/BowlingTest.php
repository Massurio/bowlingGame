<?php

namespace BowlingTest;

use Code\Game;
use PHPUnit\Framework\TestCase;

class BowlingTest extends TestCase
{
    /**
     * @param int $n
     * @param Game $game
     * @param int $pins
     * @return void
     */
    private function rollMany(int $n, Game $game, int $pins): void
    {
        for ($i = 0; $i < $n; $i++) {
            $game->roll($pins);
        }
    }

    /**
     * @param Game $game
     * @return void
     */
    private function rollSpare(Game $game): void
    {
        $game->roll(5);
        $game->roll(5);
    }


    public function testCanCreateGame()
    {
        $game = new Game();
        self::expectNotToPerformAssertions();
    }

    public function testCanRoll()
    {
        $game = new Game();
        $game->roll(0);
        self::expectNotToPerformAssertions();
    }

    public function testGutterGame()
    {
        $game = new Game();
        $n = 20;
        $pins = 0;
        $this->rollMany($n, $game, $pins);
        $this->assertEquals(0, $game->score());
    }

    public function testAllOnes()
    {
        $game = new Game();
        $this->rollMany(20, $game, 1);
        $this->assertEquals(20, $game->score());
    }

    public function testOneSpare()
    {
        $game = new Game();
        $this->rollSpare($game);
        $game->roll(3);
        $this->rollMany(17, $game, 0);
        $this->assertEquals(16, $game->score());
    }

    public function testOneStrike()
    {
        $game = new Game();
        $game->roll(10);
        $game->roll(3);
        $game->roll(4);
        $this->rollMany(16, $game, 0);
        $this->assertEquals(24, $game->score());
    }

    public function testPerfectGame()
    {
        $game = new Game();
        $this->rollMany(12, $game, 10);
        $this->assertEquals(300, $game->score());
    }
}
