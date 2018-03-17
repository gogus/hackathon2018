<?php

namespace Gtw\Api\Repository;

use Gtw\Entity\UserAddress;

class BikePointAroundUser extends RepositoryAbstract implements RepositoryInterface
{
    public function getData($params) {
        $radius = 10000;
        
        $db = $this->container->get('db');
        $table = $db->table('address');
        $addressData = $table->where('user_id', '=', $params['userId'])->limit(1)->get()->first();
        $address = UserAddress::existing((array)$addressData);

        $this->client = $this->container->get('bikepoints_around_client');
        $bikePointsHome = $this->client->getData(
            $address->home_geo_long,
            $address->home_geo_lat,
            $radius
        );
        $bikePointsWork = $this->client->getData(
            $address->work_geo_long,
            $address->work_geo_lat,
            $radius
        );

        return [
            'home' => $bikePointsHome,
            'work' => $bikePointsWork
        ];
    }
}
