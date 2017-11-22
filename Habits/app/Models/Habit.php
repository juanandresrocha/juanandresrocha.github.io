<?php

namespace App\Models; 

use App\BadOrangeScoreCalculator;
use App\BadRedScoreCalculator;
use App\BadYGBScoreCalculator;
use App\GoodBlueScoreCalculator;
use App\GoodGreenScoreCalculator;
use App\GoodROYScoreCalculator;

class Habit
{

    protected $userID, $name, $difficulty, $score, $range, $scoreCalculatorMethod;

    public function __construct($userID, $name, $difficulty)
    {
        $this->userID = $userID;
        $this->name = $name;
        $this->difficulty = $difficulty;
        $this->score = 0;
        $this->range = "Orange";
    }

    public function markHabit($typeOfMark)
    {
        $this->chooseCalculatorMethod($typeOfMark, $this->getRange());
        $this->setScore($this->getScoreCalculatorMethod()->calculateScore($this->getDifficulty(), $this->getScore()));
    }

    public function chooseCalculatorMethod($typeOfMark, $range)
    {
        if($typeOfMark == "Good"){
            switch ($range){
                case "Red":
                case "Orange":
                case "Yellow":
                    $this->setCalculatorMethod(new GoodROYScoreCalculator());
                    break;
                case "Green":
                    $this->setCalculatorMethod(new GoodGreenScoreCalculator());
                    break;
                case "Blue":
                    $this->setCalculatorMethod(new GoodBlueScoreCalculator());
            }
        }
        elseif($typeOfMark == "Bad") {
            switch ($range){
                case "Yellow":
                case "Green":
                case "Blue":
                    $this->setCalculatorMethod(new BadYGBScoreCalculator());
                    break;
                case "Orange":
                    $this->setCalculatorMethod(new BadOrangeScoreCalculator());
                    break;
                case "Red":
                    $this->setCalculatorMethod(new BadRedScoreCalculator());
            }
        }

    }

    public function setCalculatorMethod($calculatorMethod)
    {
        $this->scoreCalculatorMethod = $calculatorMethod;
    }

    public function getScoreCalculatorMethod()
    {
        return $this->scoreCalculatorMethod;
    }

    public function setRange()
    {
        if ($this->getScore() < 0) {
            $this->range = "Red";
        } elseif ($this->getScore() <= 10) {
            $this->range = "Orange";
        } elseif ($this->getScore() <= 40) {
            $this->range = "Yellow";
        } elseif ($this->getScore() <= 50) {
            $this->range = "Green";
        } else {
            $this->range = "Blue";
        }
    }

    public function getRange()
    {
        return $this->range;
    }

    public function setUserID($userID) 
    {
        $this->userID = $userID;
    }

    public function getUserID()
    {
        return $this->userID;
    }
    
    public function setName($name) 
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;
    }

    public function getDifficulty()
    {
        return $this->difficulty;
    }
    
    public function setScore($score) 
    {
        $this->score = $score;
        $this->setRange();
    }

    public function getScore()
    {
        return $this->score;
    }



}