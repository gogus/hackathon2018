<?php

namespace Gtw\Api\Repository;

use Slim\Container;

class RepositoryAbstract {    
    /** 
     * @var Slim\Container 
     */
    protected $container;
    
    /**
     *
     * @var \Gtw\Api\Client\BikePointAround
     */
    protected $client;

    public function __construct(Container $container) {
        $this->container = $container;
    }
}
