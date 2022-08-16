<?php

namespace Backend\Car\Repositories\Interfaces;

use Backend\Core\Repositories\Interfaces\RepositoryInterface;

interface CarInterface extends RepositoryInterface
{
    public function paginate($limit = null, $columns = ['*']);
}
