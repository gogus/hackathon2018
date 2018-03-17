<?php

return [
    'db' => function ($container) {
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($container['settings']['db']);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    },
    'guzzle' => function () {
        return new \GuzzleHttp\Client();
    },
    'bikepoints_around_client' => function ($container) {
        return new Gtw\Api\Client\BikePointAround($container);
    },
    'bikepoints_around_user' => function ($container) {
        return new Gtw\Api\Repository\BikePointAroundUser($container);
    }
];
