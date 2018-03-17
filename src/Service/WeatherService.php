<?php

namespace Gtw\Service;

use Gtw\OpenData\WeatherApiClient;
use Gtw\RewardEngine\Weather;
use GuzzleHttp\Exception\GuzzleException;

class WeatherService
{
    /**
     * @var WeatherApiClient
     */
    private $openDataWeatherApiClient;

    /**
     * @param WeatherApiClient $openDataWeatherApiClient
     *
     */
    public function __construct(WeatherApiClient $openDataWeatherApiClient)
    {
        $this->openDataWeatherApiClient = $openDataWeatherApiClient;
    }

    /**
     * @throws GuzzleException
     */
    public function getCurrentWeatherConditions()
    {
        $weatherData = (array)$this->openDataWeatherApiClient->getWeather();
        $weatherDescription = $weatherData['weather']['description'];

        // todo: map weather conditions
        $conditions = [Weather::NORMAL, Weather::SNOW, Weather::RAIN];

        return $conditions[array_rand($conditions)];
    }
}