<?php
/**
 * Created by PhpStorm.
 * User: Mike Bas
 * Date: 11/20/2017
 * Time: 8:54 PM
 */

require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

const APIKEY = 'AIzaSyDkktUYb8Ya__fWSKqslkaY6eArIJKIbVc';
const SERVICEPATH = '/key/architecture-habbits-firebase-adminsdk-trgz6-d204782aaa.json';

$serviceAccount = ServiceAccount::fromJsonFile(__DIR__. SERVICEPATH);
$apiKey = APIKEY;

$firebase = (new Factory)
    ->withServiceAccountAndApiKey($serviceAccount, $apiKey)
    ->withDatabaseUri('https://architecture-habbits.firebaseio.com/')
    ->create();

$database = $firebase->getDatabase();

$reference = $database->getReference('habits/-KzRdWwJGXbc877P6qYX');
$snapshot = $reference->getSnapshot();

/*$data = array(
    'userID' => 'MikeID',
    'name' => 'Study Archtecture',
    'difficulty' => 'Hard',
    'score' => 0,
    'range' => 'Orange',
);*/

//$newHabitKey = $database->getReference('habits')->push([
//    'userID' => $data['userID'],
//    'name' => $data['name'],
//    'difficulty' => $data['difficulty'],
//    'score' => $data['score'],
//    'range' => $data['range'],
//])->getKey();

var_dump($snapshot->getValue());