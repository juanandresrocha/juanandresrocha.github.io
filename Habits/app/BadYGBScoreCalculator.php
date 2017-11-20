<?php

namespace App;

class BadYGBScoreCalculator extends BasicCalculator implements ScoreCalculator
{

    public function calculateScore($difficulty, $score)
    {
        // TODO: Implement calculateScore() method.
        $pointsToReduce = $this->calculatePoints($difficulty);
        return $score - $pointsToReduce;
    }

}