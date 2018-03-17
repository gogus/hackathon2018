<?php

namespace Gtw\Action;

use Gtw\Entity\User;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Interop\Container\Exception\ContainerException;
use Psr\Http\Message\ResponseInterface;
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
        $userData = $this->table
            ->where('username', '=', $args['username'])
            ->limit(1)
            ->get()
            ->first();

        $user = User::existing((array)$userData);

        return $response->withJson($user->toArray());
    }
}