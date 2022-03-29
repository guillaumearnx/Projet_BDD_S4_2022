<?php

use gamepedia\db\Eloquent;
use Slim\{App, Container};
use gamepedia\controllers\APIController;

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

Eloquent::start(__DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'conf' . DIRECTORY_SEPARATOR . 'conf.ini');

#App et Container
$container = new Container();
$container['settings']['displayErrorDetails'] = true;
$app = new App($container);

#Redirection du traffic dans l'application
$app->group('/api', function ($app) {
    $app->get("/games/{id:[0-9]+}[/]", function ($request, $response, $args) {
        return (new APIController($this, $request, $response, $args))->getGame();
    })->setName('createurs');

    $app->get("/games[/]", function ($request, $response, $args) {
        return (new APIController($this, $request, $response, $args))->getAllGames();
    })->setName('createurs');
});

#Demmarage de l'application
try {
    $app->run();
} catch (Throwable $e) {
    header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error', true, 500);
    echo '<h1>Something went wrong!</h1>';
    print_r($e);
    exit;
}