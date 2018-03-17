<?php

namespace Gtw\Action;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Container;
use Slim\Http\Response;

class PatchUserPoints
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
        $this->table = $db->table('points');
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        /** @var Response $response */

        $this->table->where('user_id', '=', $args['userId'])
            ->update([
                'points' => $request->getParam('points')
            ]);

        $user = $this->table->where('user_id', '=', $args['userId'])->get();

        return $response->withJson($user);
    }
}