<?php

namespace Backend\Car\Repositories\Interfaces;

use Backend\Core\Repositories\Interfaces\RepositoryInterface;

interface CarInterface extends RepositoryInterface
{
    public function getListCarHomepage(array $where, $limit = 10, $select = ['*'], $column = 'id', $order = 'desc');
}
