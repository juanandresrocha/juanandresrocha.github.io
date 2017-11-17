<?php

namespace App\Models; 

class Habit 
{

    protected $userID, $name, $type, $difficulty, $score;

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
    
    public function setType($type) 
    {
        $this->type = $type;
    }

    public function getType()
    {
        return $this->type;
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
    }

    public function getScore()
    {
        return $this->score;
    }



}