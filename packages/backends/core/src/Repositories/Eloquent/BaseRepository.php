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

    public function make(array $with = [])
    {
        if (!empty($with)) {
            $this->model = $this->model->with($with);
        }

        return $this->model;
    }

    public function resetModel()
    {
        $model = app()->make($this->getModel());

        return $this->model = $model;
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
        $result = $this->model->create($attributes);
        $this->resetModel();

        return $result;
    }

    public function update($id, $attributes = [])
    {
        $result = $this->find($id);
        if ($result) {
            $data = $result->update($attributes);
            $this->resetModel();

            return $data;
        }

        return false;
    }

    public function delete($id)
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();
            $this->resetModel();

            return true;
        }

        return false;
    }

    /**
     * Retrieve all data of repository, paginated
     *
     * @param null|int $limit
     * @param array    $select
     * @param string   $method
     *
     * @return mixed
     */
    public function paginate($limit = null, $select = ['*'], $column = 'id', $order = 'desc')
    {
        $limit = is_null($limit) ? 10 : $limit;
        $results = $this->model->orderBy($column, $order)->paginate($limit, $select);
        $results->appends(app('request')->query());

        return $results;
    }

    /**
     * Find data by multiple fields
     *
     * @param array $where
     * @param array $select
     *
     * @return mixed
     */
    public function findWhere(array $where, $select = ['*'])
    {
        $this->applyConditions($where);

        $model = $this->model->get($select);

        return $model;
    }

    /**
     * Applies the given where conditions to the model.
     *
     * @param array $where
     *
     * @return void
     */
    protected function applyConditions(array $where)
    {
        foreach ($where as $field => $value) {
            if (is_array($value)) {
                [$field, $condition, $val] = $value;
                switch (strtoupper($condition)) {
                    case 'IN':
                        $this->model = $this->model->whereIn($field, $val);
                        break;
                    case 'NOTIN':
                        $this->model = $this->model->whereNotIn($field, $val);
                        break;
                    default:
                        $this->model = $this->model->where($field, $condition, $val);
                }
            } else {
                $this->model = $this->model->where($field, '=', $value);
            }
        }
    }
    /**
     * [getFirstBy description]
     * @param  array  $attributes  [description]
     * @param  array  $where   [description]
     * @param  array  $select [description]
     * @return [type]          [description]
     */
    public function getFirstBy(array $condition = [], array $select = ['*'])
    {
        $this->applyConditions($condition);
        if (!empty($select)) {
            $model = $this->model->select($select);
        } else {
            $model = $this->model->select('*');
        }

        return $model->first();
    }

    /**
     * Update or Create an entity in repository
     *
     * @param array $attributes
     * @param array $values
     *
     * @return mixed
     * @throws ValidatorException
     *
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        $result = $this->model->updateOrCreate($attributes, $values);
        $this->resetModel();

        return $result;
    }

    public function pluck($column, $key = null, array $condition = [])
    {
        $this->applyConditions($condition);

        $select = [$column];
        if (!empty($key)) {
            $select = [$column, $key];
        }

        $data = $this->model->select($select);

        return $data->pluck($column, $key)->all();
    }
}
