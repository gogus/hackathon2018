<?php

namespace Gtw\Api\Repository;

use Gtw\Api\Client\BikePointAround;
use Gtw\Entity\UserAddress;
use Illuminate\Database\Capsule\Manager;

class BikePointAroundUser extends RepositoryAbstract implements RepositoryInterface
{
    public function getData($params) {
        $radius = 1000;
        /** @var Manager $db */
        /** @noinspection PhpUnhandledExceptionInspection */
        $db = $this->container->get('db');
        $table = $db->table('address');
        $addressData = $table->where('user_id', '=', $params['userId'])->limit(1)->get()->first();
        $address = UserAddress::existing((array)$addressData)->toArray();

        /** @var BikePointAround $client */
        /** @noinspection PhpUnhandledExceptionInspection */
        $client = $this->container->get('bikepoints_around_client');
        switch ($params['place'])
        {
            case 'home':
                {
                    $bikePoints = $client->getData(
                        [
                            'lon' => $address['home_geo_long'],
                            'lat' => $address['home_geo_lat'],
                            'radius' => $radius
                        ]
                    );
                }
                break;

            case 'work':
                {
                    $bikePoints = $client->getData(
                        [
                            'lon' => $address['work_geo_long'],
                            'lat' => $address['work_geo_lat'],
                            'radius' => $radius
                        ]
                    );
                }
                break;
        
            default:
                throw new \InvalidArgumentException('Place should be home / work!');
        }
 
        return $bikePoints;
    }
}
