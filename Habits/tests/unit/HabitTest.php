<?php

use PHPUnit\Framework\TestCase;

class HabitTest extends TestCase
{
    public function testThatWeCanGetuserID() 
    {
        $habit = new \App\Models\Habit;
        
        $habit->setUserID('RandomToken');

        $this->assertEquals($habit->getUserID(), 'RandomToken');
    }
    
    public function testThatWeCanGetHabitName() 
    {
        $habit = new \App\Models\Habit;
        
        $habit->setName('Estudiar Arquitectura');

        $this->assertEquals($habit->getName(), 'Estudiar Arquitectura');
    }
    
    public function testThatWeCanGetHabitType() 
    {
        $habit = new \App\Models\Habit;
        
        $habit->setType('Good');

        $this->assertEquals($habit->getType(), 'Good');
    }

}