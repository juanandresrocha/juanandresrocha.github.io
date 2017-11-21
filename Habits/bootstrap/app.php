<?php
/**
 * Created by PhpStorm.
 * User: Mike Bas
 * Date: 11/20/2017
 * Time: 1:06 PM
 */

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/habits', function (Request $request, Response $response, $args) {

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits');

    $snapshot = $reference->getSnapshot()->getValue();

    return $response->withStatus(200)->write(json_encode($snapshot));
});

$app->get('/habit/[{id}]', function (Request $request, Response $response, $args) {

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/' . $args['id']);

    $snapshot = $reference->getSnapshot()->getValue();

    return $response->withStatus(200)->write(json_encode($snapshot));
});

$app->post('/habit/new', function (Request $request, Response $response, $args) {

    $data = $request->getParsedBody();
    $habit = new \App\Models\Habit($data['userID'], $data['name'], $data['difficulty']);

    return $response->withStatus(201)->write('Habit generated successfully');
});

$app->put('/habit/update/{id}', function(Request $request, Response $response, $args){
    // $habit = \App\Models\Habit::find();
});

$app->delete('/habit/delete/{id}', function(Request $request, Response $response, $args){

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/' . $args['id']);

    $reference->remove();

    return $response->withStatus(200)->write('Habit deleted successfully');
});