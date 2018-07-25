<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes
$app->get('/phpinfo', function (Request $request, Response $response, array $args) {
    $response->getBody()->write(phpinfo());
    return $response;
});

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    // return $this->renderer->render($response, 'index.phtml', $args);
    $body = $this->renderer->render('index.html', $args);
    $response->getBody()->write($body);
    return $response;
});

