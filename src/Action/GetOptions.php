<?php

namespace Gtw\Action;

use Gtw\RewardEngine\RewardEngine;
use Gtw\RewardEngine\RideOption;
use Gtw\RewardEngine\TransportType;
use Gtw\Service\BikePointsService;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Database\Capsule\Manager;
use Illuminate\Database\Query\Builder;
use Interop\Container\Exception\ContainerException;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

class GetOptions
{
    /**
     * @var Builder
     */
    protected $addressTable;

    /**
     * @var Builder
     */
    protected $carTable;

    /**
     * @var BikePointsService
     */
    private $bikePointsService;

    /**
     * @var RewardEngine
     */
    private $rewardEngine;

    /**
     * @param Container $container
     *
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        /** @var Manager $db */
        $db = $container->get('db');
        $this->db = $container->get('db');
        $this->addressTable = $db->table('address');
        $this->carTable = $db->table('car');
        $this->bikePointsService = $container->get(BikePointsService::class);
        $this->rewardEngine = $container->get(RewardEngine::class);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @param array $args
     *
     * @return Response
     * @throws GuzzleException
     */
    public function __invoke(Request $request, Response $response, array $args)
    {
        $options = [];
        $addressData = $this->addressTable->where('user_id', '=', $args['userId'])->limit(1)->get()->first();
        $carData = $this->carTable->where('user_id', '=', $args['userId'])->limit(1)->get()->first();
        $getDirection = $this->getDirection($addressData);

        /**
         * self car
         */
        if (!empty($carData->user_id)) {
            $option = array_merge(
                $getDirection,
                [
                    'option_description' => 'Want to go by Car ? it\'s ok you can still go green by doing car share ',
                    'transport_type' => TransportType::OWN_CAR
                ]
            );
            $option = $this->populateReward($option);
            $options[] = $option;
        }

        $carNearByOption = $this->getNearByCar($getDirection, $addressData, $args['userId']);
        if (!empty($carNearByOption)) {
            $options[] = $carNearByOption;
        }

        //get  the bikes near me
        //if not available don/'t show bike'
        $bikes = $this->bikePointsService->getBikePointsAroundUserPlace($addressData->user_id, 'home');

        if ($bikes) {
            $option =
                array_merge(
                    $getDirection,
                    [
                        'option_description' => 'Riding the bike can improve your health and also can help you loose extra pund in the same time improving your life your also getting rewards',
                        'transport_type' => TransportType::BIKE,
                    ]
                );
            $option = $this->populateReward($option);
            $options[] = $option;
        }

        return $response->withJson($options);
    }


    private function getNearByCar($getDirection, $addressData, $userId)
    {
        $options = [];
        /**
         * shared  car if any in the area
         */

        $nearByCars = $this->db->table('car')->where('user_id', '<>', $userId)->get();

        $usersWithCars = [];

        foreach ($nearByCars as $nearCar) {

            $usersWithCars[] = $nearCar->user_id;
        }

        $coodinatesData = $this->db->table('address')->whereIn('user_id', $usersWithCars)->get();

        $shareCar = false;

        if (!empty($coodinatesData)) {
            foreach ($coodinatesData as $cord) {
                $distance = $this->checkDistance($addressData->home_geo_lat, $addressData->home_geo_long, $cord->home_geo_lat, $cord->home_geo_long);
                if (($distance / 1000) < 5) {
                    $shareCar = true;
                }
            }
        }

        if ($shareCar) {
            $option = array_merge(
                $getDirection,
                [
                    'option_description' => 'Go green by doing car share!',
                    'transport_type' => TransportType::SHARED_CAR,
                ]
            );
            $option = $this->populateReward($option);
            $options[] = $option;
        }

        return $options;
    }


    /**
     * setting the direction by time
     * if before 12 then going to work
     * otherwise going back to home
     * @param $addressData
     * @return array
     */
    private function getDirection($addressData)
    {
        if (date('H') > 1 && date('H') > 12) {
            return [
                'origin_lat' => $addressData->home_geo_lat,
                'origin_lon' => $addressData->home_geo_long,
                'dest_lat' => $addressData->work_geo_lat,
                'dest_lon' => $addressData->work_geo_long,
            ];
        } else {
            return [
                'origin_lat' => $addressData->work_geo_lat,
                'origin_lon' => $addressData->work_geo_long,
                'dest_lat' => $addressData->home_geo_lat,
                'dest_lon' => $addressData->home_geo_long,
            ];
        }
    }

    /**
     * Calculates the great-circle distance between two points, with the Haversine formula.
     *
     * @param float $latitudeFrom Latitude of start point in [deg decimal]
     * @param float $longitudeFrom Longitude of start point in [deg decimal]
     * @param float $latitudeTo Latitude of target point in [deg decimal]
     * @param float $longitudeTo Longitude of target point in [deg decimal]
     * @param int $earthRadius Mean earth radius in [m]
     *
     * @return float Distance between points in [m] (same as earthRadius)
     */
    private function checkDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);
        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));

        return $angle * $earthRadius;
    }

    /**
     * @param array $option
     *
     * @throws GuzzleException
     *
     * @return array
     */
    private function populateReward(array $option)
    {
        $reward = $this->rewardEngine->determineReward(new RideOption($option['transport_type']));
        $option['reward_base'] = $reward->getBase();
        $option['reward_bonuses'] = [];
        foreach ($reward->getBonuses() as $bonus) {
            $option['reward_bonuses'][] = [
                'bonus_amount' => $bonus->getPoints(),
                'bonus_type' => $bonus->getType(),
            ];
        }

        return $option;
    }


}