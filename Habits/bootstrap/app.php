<?php
/**
 * Created by PhpStorm.
 * User: Mike Bas
 * Date: 11/20/2017
 * Time: 1:06 PM
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../admin/admin.php';
require 'vendor/autoload.php';


$app = new \Slim\App();

$app->get('/habits/{userID}', function (Request $request, Response $response, $args) {

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/' . $args['userID']);

    $snapshot = $reference->getSnapshot()->getValue();

    return $response->withStatus(200)->write(json_encode($snapshot));
});

$app->get('/habit/{userID}/{id}', function (Request $request, Response $response, $args) {

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/' . $args['userID'] . '/' . $args['id']);

    $snapshot = $reference->getSnapshot()->getValue();

    return $response->withStatus(200)->write(json_encode($snapshot));
});

$app->post('/habit/{userID}/new', function (Request $request, Response $response, $args) {

    $data = $request->getParsedBody();
    $habit = new \App\Models\Habit($data['userID'], $data['name'], $data['difficulty']);

    $FBConnection = new \App\FBConnection();

    $FBConnection->getDatabase()->getReference('habits/' . $args['userID'])->push([
        'name' => $habit->getName(),
        'difficulty' => $habit->getDifficulty(),
        'score' => $habit->getScore(),
        'range' => $habit->getRange(),
    ]);

    return $response->withStatus(201)->write('Habit generated successfully');
});

$app->post('/habit/update/{userID}/{id}', function(Request $request, Response $response, $args){

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/' . $args['userID'] . '/' . $args['id']);
    $data = $reference->getSnapshot()->getValue();

    $newValues = $request->getParsedBody();

    $reference->update([
        'name' => $newValues['name'] ?? $data['name'],
        'difficulty' => $newValues['difficulty'] ?? $data['difficulty'],
        'score' => $newValues['score'] ?? $data['score'],
        'range' => $newValues['range'] ?? $data['range'],
    ]);

    return $response->withStatus(200)->write('Habit updated successfully');

});

$app->delete('/habit/delete/{userID}/{id}', function(Request $request, Response $response, $args){

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/' . $args['userID'] . '/' . $args['id']);

    $reference->remove();

    return $response->withStatus(200)->write('Habit deleted successfully');
});

// Admin requests

$app->get('/admin/habits/perRange', function(Request $request, Response $response, $args){

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/');

    $habits = $reference->getSnapshot()->getValue();

    $results = getRangeResults($habits);

    return $response->withStatus(200)->write(print_r($results));

});

$app->get('/admin/habits/getWorst', function(Request $request, Response $response, $args){

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/');

    $habits = $reference->getSnapshot()->getValue();

    $result = getHabitWithLowestScore($habits);

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/' . $result['userID'] . '/' . $result['id']);

    $snapshot = $reference->getSnapshot()->getValue();

    return $response->withStatus(200)->write(json_encode($snapshot));
});

$app->get('/admin/habits/getHighest', function(Request $request, Response $response, $args){

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/');

    $habits = $reference->getSnapshot()->getValue();

    $result = getHabitWithHighestScore($habits);

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/' . $result['userID'] . '/' . $result['id']);

    $snapshot = $reference->getSnapshot()->getValue();

    return $response->withStatus(200)->write(json_encode($snapshot));
});