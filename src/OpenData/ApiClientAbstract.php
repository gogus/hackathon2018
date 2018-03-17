<?php

namespace Gtw\OpenData;

use GuzzleHttp\ClientInterface as Guzzle;
use Interop\Container\Exception\ContainerException;
use Slim\Container;

abstract class ApiClientAbstract
{
    /**
     * @var Guzzle
     */
    protected $client;

    /**
     * @param Container $container
     *
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        $this->client = $container->get('guzzle');
    }
}
