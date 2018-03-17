<?php

namespace Gtw\RewardEngine;

class ChallengingConditions
{
    /**
     * Weather::*
     *
     * @var string
     */
    protected $weatherType;

    /**
     * @var bool
     */
    protected $isRushHour;

    /**
     * @param string $weatherType
     * @param bool   $isRushHour
     *
     */
    public function __construct($weatherType, $isRushHour)
    {
        $this->weatherType = $weatherType;
        $this->isRushHour = $isRushHour;
    }

    /**
     * Return type of weather Weather::
     *
     * @return string
     */
    public function getWeatherType()
    {
        return $this->weatherType;
    }

    /**
     * @return bool
     */
    public function isRushHour()
    {
        return $this->isRushHour;
    }
}