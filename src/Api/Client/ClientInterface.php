<?php

namespace Gtw\Api\Client;

use Slim\Container;

interface ClientInterface {
    public function __construct(Container $container);

    public function getData($params);
}
