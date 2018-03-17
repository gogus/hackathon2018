<?php

namespace Gtw\RewardEngine\Rule;

use Gtw\RewardEngine\Bonus;
use Gtw\RewardEngine\ChallengingConditions;
use Gtw\RewardEngine\RideOption;
use Gtw\RewardEngine\TransportType;
use Gtw\RewardEngine\Weather;

class RainBiking extends AbstractBonusRewardRule
{
    public function getReward(RideOption $rideOption, ChallengingConditions $conditions)
    {
        if (
            $rideOption->getTransportType() === TransportType::BIKE
            &&
            (
                $conditions->getWeatherType() === Weather::RAIN
                ||
                $conditions->getWeatherType() === Weather::SNOW
            )
        ) {
            return new Bonus('Taking bike in bad weather', 100);
        }

        return null;
    }
}