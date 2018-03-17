<?php

namespace Gtw\RewardEngine;

class Reward
{
    /**
     * @var int
     */
    private $base;

    /**
     * @var Bonus[]
     */
    private $bonuses;

    /**
     * @param int $base
     */
    public function __construct($base)
    {
        $this->base = $base;
        $this->bonuses = [];
    }

    /**
     * @param Bonus[] $bonuses
     */
    public function addBonuses(array $bonuses = [])
    {
        foreach ($bonuses as $bonus) {
            $this->bonuses[] = $bonus;
        }
    }

    /**
     * @return int
     */
    public function getBase()
    {
        return $this->base;
    }

    /**
     * @return Bonus[]
     */
    public function getBonuses()
    {
        return $this->bonuses;
    }
}