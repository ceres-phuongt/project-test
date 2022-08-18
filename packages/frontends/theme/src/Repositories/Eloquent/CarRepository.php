<?php

namespace Frontend\Theme\Repositories\Eloquent;

use Backend\Car\Models\Car;
use Backend\Car\Repositories\Interfaces\CarInterface;
use Backend\Core\Repositories\Eloquent\BaseRepository;

class CarRepository extends BaseRepository implements CarInterface
{
    public function getModel()
    {
        return Car::class;
    }
}
