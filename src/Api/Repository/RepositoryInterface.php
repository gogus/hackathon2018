<?php

namespace Gtw\Api\Repository;

interface RepositoryInterface
{
    /**
     * @param mixed $params
     *
     * @return mixed
     */
    public function getData($params);
}
