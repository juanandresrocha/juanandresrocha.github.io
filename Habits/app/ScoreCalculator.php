<?php

namespace App;

interface ScoreCalculator
{

    public function calculateScore($difficulty, $score);

}