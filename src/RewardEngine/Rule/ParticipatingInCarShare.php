<?php

namespace Gtw\RewardEngine\Rule;

use Gtw\RewardEngine\Bonus;
use Gtw\RewardEngine\ChallengingConditions;
use Gtw\RewardEngine\RideOption;

class ParticipatingInCarShare extends AbstractBonusRewardRule
{
    public function getReward(RideOption $rideOption, ChallengingConditions $conditions)
    {
        if ($rideOption->getTransportType()) {
            return new Bonus('Participating in car sharing', 30);
        }

        return null;
    }
}