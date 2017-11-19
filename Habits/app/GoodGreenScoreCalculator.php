<?php

namespace App;

class GoodGreenScoreCalculator extends BasicCalculator implements ScoreCalculator
{

    public function calculateScore($difficulty, $score)
    {
        // TODO: Implement calculateScore() method.
        $pointsToAdd = $this->calculatePoints($difficulty);
        return $score + ($pointsToAdd / 2);
    }
}