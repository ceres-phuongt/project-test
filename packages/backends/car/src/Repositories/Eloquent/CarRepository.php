<?php

namespace Backend\Car\Repositories\Eloquent;

use Backend\Car\Models\Car;
use Backend\Car\Repositories\Interfaces\CarInterface;
use Backend\Core\Repositories\Eloquent\BaseRepository;

class CarRepository extends BaseRepository implements CarInterface
{
    public function getModel()
    {
        return Car::class;
    }

    public function getListCarHomepage(array $where, $limit = null, $select = ['*'], $column = 'id', $order = 'desc')
    {
        $this->applyConditions($where);
        $limit = is_null($limit) ? 10 : $limit;
        $results = $this->model->orderBy($column, $order)->paginate($limit, $select);
        $results->appends(app('request')->query());

        return $results;
    }
}
