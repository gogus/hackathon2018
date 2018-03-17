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
     * @var Builder
     */
    protected $car;

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
        $this->car = $db->table('car');
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

        if ($request->getParsedBodyParam('have_car', false)) {
            $this->car->insert([
                'user_id' => $user->getId(),
                'have_car' => 1,
                'available_seats' => $request->getParsedBodyParam('available_seats', 1)
            ]);
        }

        return $response->withJson($user->toArray());
    }
}