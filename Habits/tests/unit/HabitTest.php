<?php

use PHPUnit\Framework\TestCase;

class HabitTest extends TestCase
{
    public function testThatWeCanGetUserID() 
    {
        $habit = new \App\Models\Habit;
        
        $habit->setUserID('MikeID');

        $this->assertEquals($habit->getUserID(), 'MikeID');
    }
    
    public function testThatWeCanGetHabitName() 
    {
        $habit = new \App\Models\Habit;
        
        $habit->setName('Study Architecture');

        $this->assertEquals($habit->getName(), 'Study Architecture');
    }
    
    public function testThatWeCanGetHabitDifficulty()
    {
        $habit = new \App\Models\Habit;
        
        $habit->setDifficulty('Hard');

        $this->assertEquals($habit->getDifficulty(), 'Hard');
    }
    
    public function testThatWeCanGetHabitScore() 
    {
        $habit = new \App\Models\Habit;
        
        $habit->setScore(9);

        $this->assertEquals($habit->getScore(), 9);
    }

    // Ranges
    
    public function testThatWeCanGetHabitRedRange() 
    {
        $habit = new \App\Models\Habit;

        $habit->setScore(-1);

        $this->assertEquals($habit->getRange(), "Red");

    }
    
    public function testThatWeCanGetHabitOrangeRange() 
    {
        $habit = new \App\Models\Habit;

        $habit->setScore(0);

        $this->assertEquals($habit->getRange(), "Orange");

    }
    
    public function testThatWeCanGetHabitYellowRange() 
    {
        $habit = new \App\Models\Habit;

        $habit->setScore(40);

        $this->assertEquals($habit->getRange(), "Yellow");

    }

    public function testThatWeCanGetHabitGreenRange()
    {
        $habit = new \App\Models\Habit;

        $habit->setScore(49);

        $this->assertEquals($habit->getRange(), "Green");

    }
    
    public function testThatWeCanGetHabitBlueRange() 
    {
        $habit = new \App\Models\Habit;

        $habit->setScore(55);

        $this->assertEquals($habit->getRange(), "Blue");

    }

    // End ranges

    // Marking as good

    public function testThatWeCanMarkHabitAsGoodInROYRange()
    {
        $habit = new \App\Models\Habit("MikeID", "Study Architecture", "Hard");

        $habit->markHabit("Good");

        $this->assertEquals($habit->getScore(), 6);

    }

    public function testThatWeCanMarkHabitAsGoodInGreenRange()
    {
        $habit = new \App\Models\Habit("MikeID", "Study Security", "Medium");

        $habit->setScore(41);

        $habit->markHabit("Good");

        $this->assertEquals($habit->getScore(), 43);

    }

    public function testThatWeCanMarkHabitAsGoodInBlueRange()
    {
        $habit = new \App\Models\Habit("MikeID", "Study Security", "Medium");

        $habit->setScore(51);

        $habit->markHabit("Good");

        $this->assertEquals($habit->getScore(), 52);

    }

    // End marking as good

    // Marking as bad

    public function testThatWeCanMarkHabitAsBadInYGBRange()
    {
        $habit = new \App\Models\Habit("MikeID", "Clean desktop", "Easy");

        $habit->setScore(15);

        $habit->markHabit("Bad");

        $this->assertEquals($habit->getScore(), 13);

    }

    public function testThatWeCanMarkHabitAsBadInOrangeRange()
    {
        $habit = new \App\Models\Habit("MikeID", "Go to the gym", "Medium");

        $habit->markHabit("Bad");

        $this->assertEquals($habit->getScore(), -6);

    }

    public function testThatWeCanMarkHabitAsBadInRedRange()
    {
        $habit = new \App\Models\Habit("MikeID", "Study Architecture", "Hard");

        $habit->setScore(-10);

        $habit->markHabit("Bad");

        $this->assertEquals($habit->getScore(), -22);

    }

    // End marking as bad

}