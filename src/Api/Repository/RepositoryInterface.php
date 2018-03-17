<?php

namespace Gtw\Api\Repository;

use Slim\Container;

interface RepositoryInterface {
    public function __construct(Container $container);

    public function getData($params);
}
