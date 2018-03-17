<?php

namespace Gtw\Action;

use Gtw\Entity\User;
use Gtw\Entity\Trip;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Container;
use Slim\Http\Response;

class JoinTrip
{
    /**
     * @var Builder
     */
    protected $trip;

    protected $user;

    protected $passenger;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        /** @var Manager $db */
        $db = $container->get('db');
        $this->trip = $db->table('trip');
        $this->user = $db->table('user');
        $this->passenger = $db->table('passenger');
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        $result = ['result' => false, 'message' => ''];
        
        try {
            $tripData = $this->trip->where('id', '=', $args['tripId'])->get()->first();
            if (!$tripData) {
                throw new \InvalidargumentException('Trip not found');
            }

            if ($tripData->driver == $args['userId']) {
                throw new \InvalidargumentException('Can not join own trip');                
            }

            $userData = $this->user->where('id', '=', $args['userId'])->get()->first();
            if (!$userData) {
                throw new \InvalidargumentException('User not found');
            }
            
            $passengerCount = $this->passenger->where('trip_id', '=', $args['tripId'])->get()->count();
            if ($passengerCount >= $tripData->available_seats) {
                throw new \InvalidargumentException('No more available seats');
            }

            $alreadyPassenger = $this->passenger
                ->where('trip_id', '=', $args['tripId'])
                ->where('passenger', '=', $args['userId'])
                ->get()
                ->count();
            if ($alreadyPassenger) {
                throw new \InvalidargumentException('Already joined this trip');
            }

            $this->passenger->insert([
                'trip_id' => $args['tripId'],
                'passenger' => $args['userId']
            ]);

            $result['result'] = true;
            $result['message'] = 'OK';
        } catch (\Exception $ex) {
            $result['message'] = $ex->getMessage();
        }

        return $response->withJson((object)$result);
    }
}