<?php

namespace Gtw\Action;

use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Container;
use Slim\Http\Response;

class SaveUserSchedule
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
        $this->table = $db->table('schedule');
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {

        $userSchedule = $this->table->where('user_id', '=', $args['userId'])->get()->first();

        if ($userSchedule) {
            $this->table->where('user_id', '=', $args['userId'])->update(
                [
                    'flex_h' => (bool)$request->getParam('flex_h'),
                    'flex_interval' => intval($request->getParam('flex_interval')),
                    'schedule_interval_start' => $request->getParam('schedule_interval_start'),
                    'schedule_interval_end' => $request->getParam('schedule_interval_end')
                ]
            );
        }else{
            $this->table->insert('user_id', '=', $args['userId'])->update(
                [
                    'flex_h' => (bool)$request->getParam('flex_h'),
                    'flex_interval' => intval($request->getParam('flex_interval')),
                    'schedule_interval_start' => $request->getParam('schedule_interval_start'),
                    'schedule_interval_end' => $request->getParam('schedule_interval_end')
                ]
            );
        }

        /** @var Response $response */
        $user = $this->table->where('user_id', '=', $args['userId'])->get()->first();

        return $response->withJson($user);
    }
}