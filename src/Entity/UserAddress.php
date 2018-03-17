<?php

namespace Gtw\Entity;

class UserAddress
{
    /**
     * @var string
     */
    protected $userId;

    /**
     * @var string
     */
    protected $homeAddress;

    /**
     * @var string
     */
    protected $workAddress;

    /**
     * @var string
     */
    protected $homeGeoLat;

    /**
     * @var string
     */
    protected $homeGeoLong;

    /**
     * @var string
     */
    protected $workGeoLat;

    /**
     * @var string
     */
    protected $workGeoLong;

    /**
     * @param string $homeAddress
     * @param string $workAddress
     * @param string $homeGeoLat
     * @param string $homeGeoLong
     * @param string $workGeoLat
     * @param string $workGeoLong
     */
    public function __construct($homeAddress, $workAddress, $homeGeoLat, $homeGeoLong, $workGeoLat, $workGeoLong)
    {
        $this->homeAddress = $homeAddress;
        $this->workAddress = $workAddress;
        $this->homeGeoLat = $homeGeoLat;
        $this->homeGeoLong = $homeGeoLong;
        $this->workGeoLat = $workGeoLat;
        $this->workGeoLong = $workGeoLong;
    }

    /**
     * @param string $userId
     * @param array $data
     *
     * @return self
     */
    public static function create($userId, array $data)
    {
        $address = new self(
            $data['home_address'],
            $data['work_address'],
            $data['home_geo_lat'],
            $data['home_geo_long'],
            $data['work_geo_lat'],
            $data['work_geo_long']
        );
        $address->userId = $userId;

        return $address;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function existing(array $data)
    {
        $address = new self(
            $data['home_address'],
            $data['work_address'],
            $data['home_geo_lat'],
            $data['home_geo_long'],
            $data['work_geo_lat'],
            $data['work_geo_long']
        );
        $address->userId = $data['user_id'];

        return $address;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'user_id' => $this->userId,
            'home_address' => $this->homeAddress,
            'work_address' => $this->workAddress,
            'home_geo_lat' => $this->homeGeoLat,
            'home_geo_long' => $this->homeGeoLong,
            'work_geo_lat' => $this->workGeoLat,
            'work_geo_long' => $this->workGeoLong
        ];
    }
}