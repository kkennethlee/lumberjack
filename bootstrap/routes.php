<?php
// Application Routes

$app->get('/', function ($request, $response, $args) {
    // Render index view
    return $this->theme->render($response, 'slim.phtml', $args);
});

// Web Controller

$app->any('/event[/{action}]', \app\controllers\EventController::class)
    ->setName('logaction');

// // Web Controller
$app->any('/event/{action}/[{param}]', \app\controllers\EventController::class)
    ->setName('logactionparam');

// Web Controller

// $app->any('/event[/{action}]', \app\controllers\LogEventsController::class)
//     ->setName('createevent');
