<?php

namespace Gtw\Action;

use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class GetBikePointsAround
{
    /**
     *
     * @var \Gtw\Api\Repository\BikePointAroundUser
     */
    protected $repository;

    /**
     * @param Container $container
     *
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        $this->repository = $container->get('bikepoints_around_user');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     */
    public function __invoke(Request $request, Response $response, array $args = [])
    {
        return $this->repository->getData($args);
    }
}