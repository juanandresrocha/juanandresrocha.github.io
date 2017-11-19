<?php

namespace App;

class GoodBlueScoreCalculator extends BasicCalculator implements ScoreCalculator
{

    public function calculateScore($difficulty, $score)
    {
        // TODO: Implement calculateScore() method.
        return $score + 1;
    }
}