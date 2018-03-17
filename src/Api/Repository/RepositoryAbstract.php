<?php

namespace Gtw\Api\Repository;

use Slim\Container;

class RepositoryAbstract
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }
}
