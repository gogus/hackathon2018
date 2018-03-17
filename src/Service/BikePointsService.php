<?php

namespace Gtw\Service;

use Gtw\OpenData\BikePointApiClient;
use Gtw\Entity\UserAddress;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Query\Builder;
use InvalidArgumentException;

class BikePointsService
{
    /**
     * @var Builder
     */
    protected $address;

    /**
     * @var BikePointApiClient
     */
    protected $openDataBikePointApiClient;

    /**
     * @param Builder            $address
     * @param BikePointApiClient $openDataBikePointApiClient
     *
     */
    public function __construct(Builder $address, BikePointApiClient $openDataBikePointApiClient)
    {
        $this->address = $address;
        $this->openDataBikePointApiClient = $openDataBikePointApiClient;
    }

    /**
     * @param string $userId
     * @param string $place
     * @param int    $radius
     *
     * @throws GuzzleException
     *
     * @return array
     */
    public function getBikePointsAroundUserPlace($userId, $place, $radius = 1000)
    {
        $addressData = $this->address->where('user_id', '=', $userId)->limit(1)->get()->first();
        $address = UserAddress::existing((array)$addressData)->toArray();
        switch ($place)
        {
            case 'home':
                $lon = $address['home_geo_long'];
                $lat = $address['home_geo_lat'];
                break;

            case 'work':
                $lon = $address['work_geo_long'];
                $lat = $address['work_geo_lat'];
                break;
        
            default:
                throw new InvalidArgumentException('Place should be home / work!');
        }

        return $this->openDataBikePointApiClient->around($lon, $lat, $radius);
    }
}
