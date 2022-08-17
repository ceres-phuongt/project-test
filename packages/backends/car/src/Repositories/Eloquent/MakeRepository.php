<?php

namespace Backend\Car\Repositories\Eloquent;

use Backend\Car\Models\Make;
use Backend\Car\Repositories\Interfaces\MakeInterface;
use Backend\Core\Repositories\Eloquent\BaseRepository;

class MakeRepository extends BaseRepository implements MakeInterface
{
    public function getModel()
    {
        return Make::class;
    }
}
