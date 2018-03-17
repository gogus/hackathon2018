<?php

namespace Gtw\RewardEngine;

class RideOption
{
    /**
     * TransportType::*
     * 
     * @var string
     */
    protected $transportType;

    /**
     * @param string $transportType
     *
     */
    public function __construct($transportType)
    {
        $this->transportType = $transportType;
    }

    /**
     * @return string
     */
    public function getTransportType()
    {
        return $this->transportType;
    }
}