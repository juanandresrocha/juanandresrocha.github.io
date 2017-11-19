<?php

namespace App;

class BadOrangeScoreCalculator extends BasicCalculator implements ScoreCalculator
{

    public function calculateScore($difficulty, $score)
    {
        // TODO: Implement calculateScore() method.
        $pointsToReduce = $this->calculatePoints($difficulty);
        return $score - ($pointsToReduce * 1.5);
    }
}