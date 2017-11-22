<?php
/**
 * Created by PhpStorm.
 * User: Mike Bas
 * Date: 11/21/2017
 * Time: 5:46 PM
 */

function getRangeResults($habits){
    $reds = $oranges = $yellows = $greens = $blues = 0;

    foreach ($habits as $habit)
    {
        $keys = array_keys($habit);
        foreach ($keys as $key)
        {
            $range = $habit[$key]['range'];
            switch ($range)
            {
                case 'Red':
                    $reds++;
                    break;
                case 'Orange':
                    $oranges++;
                    break;
                case 'Yellow':
                    $yellows++;
                    break;
                case 'Green':
                    $greens++;
                    break;
                case 'Blue':
                    $blues++;
                    break;
            }
        }
    }

    $results = array(
        "Reds" => $reds,
        "Oranges" => $oranges,
        "Yellows" => $yellows,
        "Greens" => $greens,
        "Blues" => $blues,
    );

    return $results;

}

function getTopHabit($habits, $type)
{
    $habitArray = reset($habits);
    $firstHabit = reset($habitArray);
    $worstScore = $firstHabit['score'];

    $worstScoreUserID = key($habits);
    $worstScoreHabitID = key($habitArray);

    $operation = function ($param1, $param2)
    {
        return $param1 < $param2;
    };
    if($type == 'highest'){
        $operation = function ($param1, $param2)
        {
            return $param1 > $param2;
        };
    }

    foreach ($habits as $userID => $habit)
    {
        $keys = array_keys($habit);
        foreach ($keys as $key)
        {
            $currentScore = $habit[$key]['score'];

            if($operation($currentScore, $worstScore)){
                $worstScoreUserID = $userID;
                $worstScoreHabitID = $key;
                $worstScore = $currentScore;
            }
        }
    }

    $result = array(
        "userID" => $worstScoreUserID,
        "id" => $worstScoreHabitID,
    );

    return $result;
}