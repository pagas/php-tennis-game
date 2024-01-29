<?php

namespace App\Services;

class TennisGameService
{

    private int $playerOneScore = 0;
    private int $playerTwoScore = 0;
    private string $playerTwoName;
    private string $playerOneName;

    public function __construct(string $playerOneName, string $playerTwoName)
    {
        $this->playerOneName = $playerOneName;
        $this->playerTwoName = $playerTwoName;
    }

    public function getScore(): string
    {

        if ($this->hasWinner()) {
            return $this->playerWithHighestScore() . " wins";
        }

        if ($this->hasAdvantage()) {
            return "Advantage " . $this->playerWithHighestScore();
        }

        if ($this->isDeuce())
            return "Deuce";

        if ($this->playerOneScore == $this->playerTwoScore) {
            return $this->translateScore($this->playerOneScore) . " all";
        }

        return $this->translateScore($this->playerOneScore) . "," . $this->translateScore($this->playerTwoScore);
    }

    private function isDeuce(): bool
    {
        return $this->playerOneScore >= 3 && $this->playerTwoScore == $this->playerOneScore;
    }

    private function playerWithHighestScore(): string
    {
        if ($this->playerOneScore > $this->playerTwoScore) {
            return $this->playerOneName;
        } else {
            return $this->playerTwoName;
        }
    }

    private function hasWinner(): string
    {
        if ($this->playerTwoScore >= 4 && $this->playerTwoScore >= $this->playerOneScore + 2)
            return true;
        if ($this->playerOneScore >= 4 && $this->playerOneScore >= $this->playerTwoScore + 2)
            return true;
        return false;
    }

    private function hasAdvantage(): bool
    {
        if ($this->playerTwoScore >= 4 && $this->playerTwoScore == $this->playerOneScore + 1)
            return true;
        if ($this->playerOneScore >= 4 && $this->playerOneScore == $this->playerTwoScore + 1)
            return true;

        return false;
    }

    public function  playerOneScores(): void
    {
        $this->playerOneScore++;
    }

    public function playerTwoScores(): void
    {
        $this->playerTwoScore++;
    }

    private function translateScore(int $score): string
    {
        switch ($score) {
            case 3:
                return "Forty";
            case 2:
                return "Thirty";
            case 1:
                return "Fifteen";
            case 0:
                return "Love";
        }
        throw new \Exception("Illegal score: " . $score);
    }
}
