<?php

namespace Gtw\Action;

use Slim\Http\Request;
use Slim\Http\Response;

class GetOptions
{
    const TRANSPORT_TYPES = [
        'walk',
        'bike',
        'bus',
        'train',
        'shared-car',
        'own-car'
    ];

    public function __invoke(Request $request, Response $response, array $args)
    {
        $userId = $args['userId'];

        // travel transport - bike, bus, train, shared car, personal car
        // reward amount - reward strategy

        $transportType = $this->getRandomTransportType();

        $options = [
            [
                'origin_lat' => 49.7353504,
                'origin_lon' => 6.6091798,
                'dest_lat' => 49.6318168,
                'dest_lon' => 6.1692465,
                'transport_type' => $transportType,
                'reward_base' => $this->getRewardBase($transportType),
                'reward_bonuses' => [
                    [
                        'bonus_amount' => 1,
                        'bonus_type' => 'raining'
                    ]
                ],
            ]
        ];
    }

    /**
     * @return mixed
     */
    private function getRandomTransportType(): mixed
    {
        return self::TRANSPORT_TYPES[array_rand(self::TRANSPORT_TYPES)];
    }

    private function getRewardBase($transportType)
    {
        return 10;
    }
}