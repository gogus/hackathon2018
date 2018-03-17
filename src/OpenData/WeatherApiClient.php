<?php

namespace Gtw\OpenData;

use GuzzleHttp\Exception\GuzzleException;

class WeatherApiClient extends ApiClientAbstract
{
    /**
     * @throws GuzzleException
     *
     * @return array
     */
    public function getWeather()
    {
        $response = $this->client->request(
            'GET',
            'https://api.tfl.lu/v1/Weather'
        );

        return json_decode($response->getBody()->getContents());
    }
}