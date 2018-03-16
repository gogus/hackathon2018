<?php

require __DIR__ . '/bootstrap.php';

$app = new \Slim\App(['settings' => require __DIR__ . '/config.php']);

// routes
foreach (require __DIR__ . '/routes.php' as $name => $routeParams) {
    $method = isset($routeParams['method']) ? $routeParams['method'] : 'GET';
    $app->map([$method], $routeParams['pattern'], $routeParams['action'])->setName($name);
}

// services
$container = $app->getContainer();
foreach (require __DIR__ . '/services.php' as $name => $factory) {
    $container[$name] = $factory;
}

return $app;