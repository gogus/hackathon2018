<?php

use Gtw\OpenData\BikePointApiClient;
use Gtw\OpenData\WeatherApiClient;
use Gtw\RewardEngine\RewardEngine;
use Gtw\RewardEngine\Rule\RainBiking;
use Gtw\Service\BikePointsService;
use Gtw\Service\WeatherService;
use GuzzleHttp\Client;
use Illuminate\Database\Capsule\Manager;
use Slim\Container;

return [
    'db' => function (Container $container) {
        $capsule = new Manager;
        $capsule->addConnection($container['settings']['db']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    },
    'guzzle' => function () {
        return new Client();
    },
    BikePointsService::class => function (Container $container) {
        /** @var Manager $db */
        $db = $container->get('db');

        return new BikePointsService(
            $db->table('address'),
            new BikePointApiClient($container)
        );
    },
    WeatherService::class => function (Container $container) {
        return new WeatherService(
            new WeatherApiClient($container)
        );
    },
    RewardEngine::class => function (Container $container) {
        return new RewardEngine(
            [
                new RainBiking(),
            ],
            $container->get(WeatherService::class)
        );
    }
];
