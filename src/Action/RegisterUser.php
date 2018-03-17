<?php

namespace Gtw\Action;

use Gtw\Entity\User;
use Gtw\Entity\UserAddress;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class RegisterUser
{
    /**
     * @var Builder
     */
    protected $user;

    /**
     * @var Builder
     */
    protected $address;

    /**
     * @var Builder
     */
    protected $points;

    /**
     * @param Container $container
     *
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        /** @var Manager $db */
        $db = $container->get('db');
        $this->user = $db->table('user');
        $this->address = $db->table('address');
        $this->points = $db->table('points');
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
        $user = User::create($request->getParsedBody());
        $this->user->insert($user->toArray());
        $address = UserAddress::create($user->getId(), $request->getParsedBody());
        $this->address->insert($address->toArray());
        $this->points->insert([
            'user_id' => $user->getId(),
            'points' => 0
        ]);

        return $response->withJson($user->toArray());
    }
}