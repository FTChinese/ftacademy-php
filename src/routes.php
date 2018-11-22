<?php

use Slim\Http\Request;
use Slim\Http\Response;

$mw = function(Request $request, Response $response, $next) {
    $request = $request->withAttribute("pricingPlans", [
        "premium_year" => [
            "tier" => "高端会员",
            "cycle" => "年",
            "price" => 1998.00,
        ],
        "standard_month" => [
            "tier" => "标准会员",
            "cycle" => "月",
            "price" => 28.00,
        ],
        "standard_year" => [
            "tier" => "标准会员",
            "cycle" => "年",
            "price" => 198.00,
        ],
    ]);

    return $response;
};

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

$app->get('/subscription', function (Request $request, Response $response, array $args) {
    $body = $this->renderer->render('subscription.html');
    $response->getBody()->write($body);
    return $response;
});

$app->get("/subscription/{tier}/{cycle}", function (Request $request, Response $response, array $args) {
    $tier = $args["tier"];
    $cycle = $args["cycle"];

    $key = sprintf("%s_%s", $tier, $cycle);

    // $pricingPlans = $request->getAttribute("pricingPlans");

    // // if (!array_key_exists($key, $pricingPlans)) {
    // //     return;
    // // }

    // $plan = $pricingPlans[$key];

    $body = $this->renderer->render("payment.html");
    // $response->getBody()->write(sprintf("Tier: %s. Billing Cycle: %s", $args["tier"], $args["cycle"]));
    $response->getBody()->write($body);
})->add($mw);



