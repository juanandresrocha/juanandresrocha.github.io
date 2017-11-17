<?php

namespace App\Models; 

class Habit 
{

    protected $userID, $name;

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



}