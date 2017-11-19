<?php

namespace App;

class BasicCalculator
{

    public function calculatePoints($difficulty)
    {
        switch ($difficulty) {
            case "Hard":
                return 6;
                break;
            case "Medium":
                return 4;
                break;
            case "Easy":
                return 2;
                break;
        }
    }

}