<?php

namespace Gtw\RewardEngine;

use Gtw\RewardEngine\Rule\AbstractBonusRewardRule;

class RewardEngine
{
    /**
     * @var AbstractBonusRewardRule[]
     */
    private $rules;

    /**
     * @param AbstractBonusRewardRule[] $rules
     *
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param RideOption            $option
     * @param ChallengingConditions $conditions
     *
     * @return Reward
     */
    public function determineReward(RideOption $option, ChallengingConditions $conditions)
    {
        $reward = new Reward($this->calculateBase($option));
        $reward->addBonuses($this->calculateBonuses($option, $conditions));

        return $reward;
    }

    /**
     * @param RideOption $option
     *
     * @return int
     */
    protected function calculateBase(RideOption $option)
    {
        switch ($option->getTransportType()) {
            case TransportType::WALK:
                return 100;
            case TransportType::BIKE:
                return 80;
            case TransportType::BUS:
            case TransportType::TRAIN:
                return 40;
            case TransportType::SHARED_CAR:
                return 10;
            case TransportType::OWN_CAR:
                return 0;
            default:
                return 0;
        }
    }

    /**
     * @param RideOption            $option
     * @param ChallengingConditions $conditions
     *
     * @return Bonus[]
     */
    private function calculateBonuses(RideOption $option, ChallengingConditions $conditions)
    {
        $bonuses = [];
        foreach ($this->rules as $rule) {
            $bonus = $rule->getReward($option, $conditions);
            if ($bonus instanceof Bonus && $bonus->getPoints() !== 0) {
                $bonuses[] = $bonus;
            }
        }

        uasort($bonuses, function (Bonus $prev, Bonus $next) {
            return $prev->getPoints() - $next->getPoints();
        });

        return $bonuses;
    }
}