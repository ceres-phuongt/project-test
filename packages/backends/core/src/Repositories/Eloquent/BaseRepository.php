<?php

namespace Backend\Core\Repositories\Eloquent;

use Backend\Core\Repositories\Interfaces\RepositoryInterface;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;


    public function __construct()
    {
        $this->setModel();
    }

    abstract public function getModel();


    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function find($id)
    {
        $result = $this->model->find($id);

        return $result;
    }

    public function create($attributes = [])
    {
        return $this->model->create($attributes);
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
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
    public function paginate($limit = null, $columns = ['*'], $column = 'id', $order = 'desc')
    {
        $limit = is_null($limit) ? 10 : $limit;
        $results = $this->model->orderBy($column, $order)->paginate($limit, $columns);
        $results->appends(app('request')->query());

        return $results;
    }
}
