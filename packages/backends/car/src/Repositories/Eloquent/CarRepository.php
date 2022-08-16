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

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null|int $limit
     * @param array    $columns
     * @param string   $method
     *
     * @return mixed
     */
    public function paginate($limit = null, $columns = ['*'])
    {
        $limit = is_null($limit) ? 10 : $limit;
        $results = $this->model->paginate($limit, $columns);
        $results->appends(app('request')->query());

        return $results;
    }
}
