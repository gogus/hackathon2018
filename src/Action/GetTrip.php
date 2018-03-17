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

class GetTrip
{
    /**
     * @var Builder
     */
    protected $trip;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        /** @var Manager $db */
        $db = $container->get('db');
        $this->trip = $db->table('trip');
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $tripData = $this->trip->where('id', '=', $args['tripId'])->get()->first();
        
        return $response->withJson($tripData);
    }
}