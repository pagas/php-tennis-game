<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Services\TennisGameService;

class TennisTest extends TestCase
{
    private $game;
    private $firstPlayer = "Tom Willson";
    private $secondPlayer = "Mack Macdonald";

    function setUp(): void
    {
        $this->game = new TennisGameService($this->firstPlayer,  $this->secondPlayer);
    }

    public function testNewGameShouldReturnLoveAll()
    {
        $score = $this->game->getScore();

        $this->assertEquals("Love all", $score);
    }

    public function testPlayerOneWinsFirstBall()
    {
        $this->game->playerOneScores();

        $score = $this->game->getScore();
        $this->assertEquals("Fifteen,Love", $score);
    }

    public function testFifteenAll()
    {
        $this->game->playerOneScores();
        $this->game->playerTwoScores();

        $score = $this->game->getScore();
        $this->assertEquals("Fifteen all", $score);
    }

    public function testPlayerTwoWinsFirstTwoBalls()
    {
        $this->createScore(0, 2);

        $score = $this->game->getScore();
        $this->assertEquals("Love,Thirty", $score);
    }

    public function testPlayerOneWinsFirstThreeBalls()
    {
        $this->createScore(3, 0);
        $score = $this->game->getScore();
        $this->assertEquals("Forty,Love", $score);
    }

    public function testPlayersAreDeuce()
    {
        $this->createScore(3, 3);

        $score = $this->game->getScore();
        $this->assertEquals("Deuce", $score);
    }

    public function testPlayerOneWinsGame()
    {
        $this->createScore(4, 0);
        $score = $this->game->getScore();

        $this->assertEquals("{$this->firstPlayer} wins", $score);
    }

    public function testPlayerTwoWinsGame()
    {
        $this->createScore(1, 4);

        $score = $this->game->getScore();
        $this->assertEquals("{$this->secondPlayer} wins", $score);
    }

    public function testPlayersAreDuce4()
    {
        $this->createScore(4, 4);
        $score = $this->game->getScore();
        $this->assertEquals("Deuce", $score);
    }

    public function testPlayerTwoAdvantage()
    {
        $this->createScore(4, 5);

        $score = $this->game->getScore();
        $this->assertEquals("Advantage {$this->secondPlayer}", $score);
    }

    public function testPlayerOneAdvantage()
    {
        $this->createScore(5, 4);

        $score = $this->game->getScore();
        $this->assertEquals("Advantage {$this->firstPlayer}", $score);
    }

    public function testPlayerTwoWins()
    {
        $this->createScore(2, 4);
        $score = $this->game->getScore();
        $this->assertEquals("{$this->secondPlayer} wins", $score);
    }


    public function testPlayerTwoWinsAfterAdvantage()
    {
        $this->createScore(6, 8);
        $score = $this->game->getScore();
        $this->assertEquals("{$this->secondPlayer} wins", $score);
    }

    public function testPlayerOneWinsAfterAdvantage()
    {
        $this->createScore(8, 6);
        $score = $this->game->getScore();
        $this->assertEquals("{$this->firstPlayer} wins", $score);
    }

    private function createScore(int $playerOneBalls, int $playerTwoBalls)
    {
        for ($i = 0; $i < $playerOneBalls; $i++) {
            $this->game->playerOneScores();
        }
        for ($i = 0; $i < $playerTwoBalls; $i++) {
            $this->game->playerTwoScores();
        }
    }
}
