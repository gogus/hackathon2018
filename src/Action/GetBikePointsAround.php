<?php

namespace Gtw\Action;

use Gtw\Service\BikePointsService;
use GuzzleHttp\Exception\GuzzleException;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class GetBikePointsAround
{
    /**
     * @var BikePointsService
     */
    protected $service;

    /**
     * @param Container $container
     *
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        $this->service = $container->get(BikePointsService::class);
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @throws ContainerException
     * @throws GuzzleException
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args = [])
    {
        $bikePointsAroundUserPlace = $this->service->getBikePointsAroundUserPlace($args['userId'], $args['place']);

        return $response->withJson($bikePointsAroundUserPlace);
    }
}