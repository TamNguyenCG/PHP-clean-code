<?php

class TennisGame
{
    const SCORE_0 = 0;
    const SCORE_1 = 1;
    const SCORE_2 = 2;
    const SCORE_3 = 3;
    const SCORE_4 = 4;
    public string $score = '';

    public function getScore($player1Name, $player2Name, $player1Score, $player2Score)
    {
        if ($player1Score == $player2Score) {
            $this->score = match ($player1Score) {
                self::SCORE_0 => "Love-All",
                self::SCORE_1 => "Fifteen-All",
                self::SCORE_2 => "Thirty-All",
                self::SCORE_3 => "Forty-All",
                default => "Deuce",
            };
        } else if ($player1Score >= self::SCORE_4 || $player2Score >= self::SCORE_4) {
            $this->extracted1($player1Score, $player2Score);
        } else {
            $this->extracted($player1Score, $player2Score);
        }
    }


    /**
     * @param $player1Score
     * @param $player2Score
     */
    public function extracted($player1Score, $player2Score): void
    {
        for ($i = self::SCORE_1; $i < self::SCORE_3; $i++) {
            if ($i == self::SCORE_1) {
                $tempScore = $player1Score;
            } else {
                $this->score .= "-";
                $tempScore = $player2Score;
            }
            $this->score .= match ($tempScore) {
                self::SCORE_0 => "Love",
                self::SCORE_1 => "Fifteen",
                self::SCORE_2 => "Thirty",
                self::SCORE_3 => "Forty",
            };
        }
    }

    /**
     * @param $player1Score
     * @param $player2Score
     */
    public function extracted1($player1Score, $player2Score): void
    {
        $minusResult = $player1Score - $player2Score;
        if ($minusResult == 1) {
            $this->score = "Advantage player1";
        } else if ($minusResult == -1) {
            $this->score = "Advantage player2";
        } else if ($minusResult >= 2) $this->score = "Win for player1";
        else $this->score = "Win for player2";
    }

    public function __toString(): string
    {
        return $this->score;
    }

}