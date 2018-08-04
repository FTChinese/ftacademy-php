<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/', function (Request $request, Response $response, array $args) {

    // ChromePhp::log(getcwd());
    // ChromePhp::log(__FILE__);
    // ChromePhp::log(__DIR__);
    // Render index view
    // return $this->renderer->render($response, 'index.phtml', $args);
    $body = $this->renderer->render('index.html');
    $response->getBody()->write($body);
    return $response;
});

$app->get('/phpinfo', function (Request $request, Response $response, array $args) {
    $response->getBody()->write(phpinfo());
    return $response;
});

$app->get('/subscription', function (Request $request, Response $response, array $args) {
    $body = $this->renderer->render('/subscription.html');
    $response->getBody()->write($body);
    return $response;
});



