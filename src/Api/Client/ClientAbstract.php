<?php

namespace Gtw\Api\Client;

use Interop\Container\Exception\ContainerException;
use Slim\Container;

abstract class ClientAbstract {

    /**
     *
     * @var GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @param Container $container
     *
     * @throws ContainerException
     */
    public function __construct(Container $container)
    {
        /** @var Manager $db */
        $this->client = $container->get('guzzle');
    }
}
