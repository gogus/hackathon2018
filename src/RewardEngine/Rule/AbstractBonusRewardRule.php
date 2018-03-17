<?php

namespace Gtw\RewardEngine\Rule;

use Gtw\RewardEngine\Bonus;
use Gtw\RewardEngine\ChallengingConditions;
use Gtw\RewardEngine\RideOption;

abstract class AbstractBonusRewardRule
{
    /**
     * @param RideOption            $rideOption
     * @param ChallengingConditions $conditions
     *
     * @return Bonus
     */
    abstract public function getReward(RideOption $rideOption, ChallengingConditions $conditions);
}