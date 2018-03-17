<?php

namespace Gtw\Action;

use Gtw\Entity\UserAddress;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class GetOptions
{

    private $transportTypes = [
//        'walk',
        'bike',
        'bus',
        'train',
        'shared-car',
        'own-car'
    ];

    /**
     * @var Builder
     */
    protected $addressTable;

    /**
     * @var Builder
     */
    protected $carTable;
    
    /**
     * @param Container $container
     *
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        /** @var Manager $db */
        $db = $container->get('db');
        $this->addressTable = $db->table('address');
        $this->carTable = $db->table('car');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        $addressData = $this->addressTable->where('user_id', '=', $args['userId'])->limit(1)->get()->first();
        $carData = $this->carTable->where('user_id', '=', $args['userId'])->limit(1)->get()->first();

        // travel transport - bike, bus, train, shared car, personal car
        // reward amount - reward strategy

        $transportType = $this->getRandomTransportType();


        $options = [
            [
                'origin_lat' => $addressData->home_geo_lat,
                'origin_lon' => $addressData->home_geo_long,
                'dest_lat' => $addressData->work_geo_lat,
                'dest_lon' => $addressData->work_geo_long,
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

        return $response->withJson($options);
    }

    /**
     * @return mixed
     */
    private function getRandomTransportType()
    {
        return $this->transportTypes[array_rand($this->transportTypes)];
    }

    private function getRewardBase($transportType)
    {
        return 10;
    }
}