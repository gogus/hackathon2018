<?php

namespace Gtw\OpenData;

use GuzzleHttp\Exception\GuzzleException;

class BikePointApiClient extends ApiClientAbstract
{
    /**
     * https://docs.api.tfl.lu/v1/en/RESTAPIs/BikePoint/around.html
     *
     * @param string $lon
     * @param string $lat
     * @param int    $radius
     *
     * @throws GuzzleException
     *
     * @return array
     */
    public function around($lon, $lat, $radius)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        $response = $this->client->request(
            'GET',
            sprintf('https://api.tfl.lu/v1/BikePoint/around/%s/%s/%s', $lon, $lat, $radius)
        );

        return json_decode($response->getBody()->getContents());
    }
}
