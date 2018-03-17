<?php

namespace Gtw\RewardEngine;

use Gtw\RewardEngine\Rule\AbstractBonusRewardRule;
use Gtw\Service\WeatherService;
use GuzzleHttp\Exception\GuzzleException;

class RewardEngine
{
    /**
     * @var AbstractBonusRewardRule[]
     */
    private $rules;

    /**
     * @var WeatherService
     */
    private $weatherService;

    /**
     * @param AbstractBonusRewardRule[] $rules
     * @param WeatherService            $weatherService
     *
     */
    public function __construct(array $rules, WeatherService $weatherService)
    {
        $this->rules = $rules;
        $this->weatherService = $weatherService;
    }

    /**
     * @param RideOption $option
     *
     * @throws GuzzleException
     *
     * @return Reward
     */
    public function determineReward(RideOption $option)
    {
        $reward = new Reward($this->calculateBase($option));
        $conditions = new ChallengingConditions($this->weatherService->getCurrentWeatherConditions(),false);
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