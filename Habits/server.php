<?php
/**
 * Created by PhpStorm.
 * User: Mike Bas
 * Date: 11/19/2017
 * Time: 8:36 PM
 */

require __DIR__ . '/vendor/autoload.php';

use App\Models\Habit;

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/key/architecture-habbits-firebase-adminsdk-trgz6-d204782aaa.json');
$apiKey = 'AIzaSyDkktUYb8Ya__fWSKqslkaY6eArIJKIbVc';

$firebase = (new Factory)
    ->withServiceAccountAndApiKey($serviceAccount, $apiKey)
    ->create();

$database = $firebase->getDatabase();
$reference = $database->getReference('habits')->set([
    "userID" => "MikeID",
    "name" => "Study Architecture",
    "difficulty" => "Hard",
]);

$myHabit = new \App\Models\Habit("MikeID", "Study Architecture", "Hard");
echo $myHabit->getRange();