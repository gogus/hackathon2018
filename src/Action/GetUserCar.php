<?php

namespace Gtw\Action;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Container;
use Slim\Http\Response;

class GetUserCar
{
    /**
     * @var Builder
     */
    protected $table;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        /** @var Manager $db */
        $db = $container->get('db');
        $this->table = $db->table('car');
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        /** @var Response $response */
        $user = $this->table->where('user_id', '=', $args['userId'])->get()->first();

        return $response->withJson($user);
    }
}