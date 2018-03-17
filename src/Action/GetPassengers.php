<?php

namespace Gtw\Action;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Container;
use Slim\Http\Response;

class GetPassengers
{
    /**
     * @var Builder
     */
    protected $passengers;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        /** @var Manager $db */
        $db = $container->get('db');
        $this->passenger = $db->table('passenger');
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $passengersData = $this->passenger->where('trip_id', '=', $args['tripId'])->get();
        
        return $response->withJson($passengersData);
    }
}