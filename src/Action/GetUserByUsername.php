<?php

namespace Gtw\Action;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Interop\Container\Exception\ContainerException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class GetUserByUsername
{
    /**
     * @var Builder
     */
    protected $table;

    /**
     * @param Container $container
     *
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        /** @var Manager $db */
        $db = $container->get('db');
        $this->table = $db->table('user');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return ResponseInterface
     */
    public function __invoke(Request $request, Response $response, array $args = [])
    {
        $user = $this->table->where('username', '=', $args['username'])->limit(1)->get()->first();

        return $response->withJson($user);
    }
}