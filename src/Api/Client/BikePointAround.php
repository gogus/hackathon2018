<?php

namespace Gtw\Api\Client;

class BikePointAround extends ClientAbstract implements ClientInterface
{
    public function getData($params) {
        $res = $this->client->request('GET',
            'https://api.tfl.lu/v1/BikePoint/around/' . $params['lon'] .'/' . $params['lat'] . '/' . $params['radius']);

        return $res->getBody();
    }
}
