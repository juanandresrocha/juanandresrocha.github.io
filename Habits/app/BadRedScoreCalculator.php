<?php

namespace App;

class BadRedScoreCalculator extends BasicCalculator implements ScoreCalculator
{

    public function calculateScore($difficulty, $score)
    {
        // TODO: Implement calculateScore() method.
        $pointsToReduce = $this->calculatePoints($difficulty);
        return $score - ($pointsToReduce * 2);
    }
}