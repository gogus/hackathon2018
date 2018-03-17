<?php

namespace Gtw\RewardEngine;

class Bonus
{
    /**
     * @var string
     */
    protected $type;

    /**
     * Can be negative, and then it's a penalty
     *
     * @var int
     */
    protected $points;

    /**
     * @param string $type
     * @param int    $points*
     */
    public function __construct($type, $points)
    {
        $this->type = $type;
        $this->points = $points;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

}