<?php

namespace Gtw\Entity;

use Ramsey\Uuid\Uuid;

final class Trip
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $driver;
    
    /**
     * @var string
     */
    private $startTime;
    
    /**
     * @var string
     */
    private $startAddress;

    /**
     * @var string
     */
    private $destinationAddress;

    /**
     * @var string
     */
    private $startGeoLat;

    /**
     * @var string
     */
    private $startGeoLong;

    /**
     * @var string
     */
    private $destinationGeoLat;

    /**
     * @var string
     */
    private $destinationGeoLong;

    /**
     * @var int
     */
    private $availableSeats;
    
    /**
     */
    public function __construct(
        $driver,
        $startTime,
        $startAddress,
        $destinationAddress,
        $startGeoLat,
        $startGeoLong,
        $destinationGeoLat,
        $destinationGeoLong,
        $availableSeats
    ) {
        $this->id = Uuid::uuid4();
        $this->driver = $driver;
        $this->startTime = $startTime;
        $this->startAddress = $startAddress;        
        $this->destinationAddress = $destinationAddress;
        $this->startGeoLat = $startGeoLat;
        $this->startGeoLong = $startGeoLong;
        $this->destinationGeoLat = $destinationGeoLat;
        $this->destinationGeoLong = $destinationGeoLong;
        $this->availableSeats = $availableSeats;
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function create(array $data)
    {        
        return new self(
            $data['driver'],
            $data['start_time'],
            $data['start_address'],
            $data['destination_address'],
            $data['start_geo_lat'],
            $data['start_geo_long'],
            $data['destination_geo_lat'],
            $data['destination_geo_long'],
            $data['available_seats']
        );
    }

    /**
     * @param array $data
     *
     * @return self
     */
    public static function existing(array $data)
    {
        $trip = self::create($data);
        $trip->id = $data['id'];

        return $trip;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->id,
            'driver' => $this->driver,
            'start_time' => $this->startTime,
            'start_address' => $this->startAddress,
            'destination_address' => $this->destinationAddress,
            'start_geo_lat' => $this->startGeoLat,
            'start_geo_long' => $this->startGeoLong,
            'destination_geo_lat' => $this->destinationGeoLat,
            'destination_geo_long' => $this->destinationGeoLong,
            'available_seats' => $this->availableSeats
        ];
    }
}