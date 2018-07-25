<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("/ route");

    // Render index view
    // return $this->renderer->render($response, 'index.phtml', $args);
    $body = $this->renderer->render('index.html');
    $this->logger->info(__DIR__);
    $response->getBody()->write($body);
    return $response;
});

$app->get('/phpinfo', function (Request $request, Response $response, array $args) {
    $response->getBody()->write(phpinfo());
    return $response;
});



