<?php
/**
 * Created by PhpStorm.
 * User: Mike Bas
 * Date: 11/20/2017
 * Time: 1:06 PM
 */

require 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/{habitID}/', function ($request, $response, $args) {

    $FBConnection = new \App\FBConnection();

    $reference = $FBConnection->getDatabase()->getReference('habits/' + $args['habitID']);

    $snapshot = $reference->getSnapshot()->getValue();

    return $response->withStatus(200)->write(print_r($snapshot));
});

$app->post('/', function ($request, $response, $args) {

    $data = $request->getParsedBody();
    $habit = new \App\Models\Habit($data['userID'], $data['name'], $data['difficulty']);

    return $response->withStatus(201)->write('Habit generated successfully');
});