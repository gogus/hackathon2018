<?php

namespace Gtw\Api\Client;

class BikePointAround extends ClientAbstract
{
    public function getData($params) {
        /** @noinspection PhpUnhandledExceptionInspection */
        $result = $this->client->request(
            'GET',
            sprintf(
                'https://api.tfl.lu/v1/BikePoint/around/%s/%s/%s',
                $params['lon'],
                $params['lat'],
                $params['radius']
            )
        );

        return $result->getBody()->getContents();
    }
}
