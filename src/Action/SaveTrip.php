<?php

namespace Gtw\Action;

use Gtw\Entity\User;
use Gtw\Entity\UserAddress;
use Gtw\Entity\Trip;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Container;
use Slim\Http\Response;

class SaveTrip
{
    /**
     * @var Builder
     */
    protected $trip;

    protected $address;
    
    protected $car;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        /** @var Manager $db */
        $db = $container->get('db');
        $this->trip = $db->table('trip');
        $this->address = $db->table('address');
        $this->car = $db->table('car');
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $tripResponse = null;
        $addressData = $this->address->where('user_id', '=', $args['userId'])->get()->first();
        $carData = $this->car->where('user_id', '=', $args['userId'])->get()->first();
        
        if ($addressData && $carData && $carData->have_car && $carData->available_seats > 0) {
            $trip = Trip::create([
                'driver' => $args['userId'],
                'start_time' => $args['date'],
                'start_address' => $addressData->home_address,
                'destination_address' => $addressData->work_address,
                'start_geo_lat' => $addressData->home_geo_lat,
                'start_geo_long' => $addressData->home_geo_long,
                'destination_geo_lat' => $addressData->work_geo_lat,
                'destination_geo_long' => $addressData->work_geo_long,
                'available_seats' => $carData->available_seats
            ]);
            $this->trip->insert($trip->toArray());

            /** @var Response $response */
            $tripResponse = $this->trip->where('id', '=', $trip->getId())->get()->first();
        }

        return $response->withJson($tripResponse);
    }
}