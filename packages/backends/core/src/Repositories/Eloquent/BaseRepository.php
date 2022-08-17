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
                list($field, $condition, $val) = $value;
                //smooth input
                $condition = preg_replace('/\s\s+/', ' ', trim($condition));

                //split to get operator, syntax: "DATE >", "DATE =", "DAY <"
                $operator = explode(' ', $condition);
                if (count($operator) > 1) {
                    $condition = $operator[0];
                    $operator = $operator[1];
                } else {
                    $operator = null;
                }
                switch (strtoupper($condition)) {
                    case 'IN':
                        $this->model = $this->model->whereIn($field, $val);
                        break;
                    case 'NOTIN':
                        $this->model = $this->model->whereNotIn($field, $val);
                        break;
                    case 'DATE':
                        if (!$operator) {
                            $operator = '=';
                        }
                        $this->model = $this->model->whereDate($field, $operator, $val);
                        break;
                    case 'DAY':
                        if (!$operator) {
                            $operator = '=';
                        }
                        $this->model = $this->model->whereDay($field, $operator, $val);
                        break;
                    case 'MONTH':
                        if (!$operator) {
                            $operator = '=';
                        }
                        $this->model = $this->model->whereMonth($field, $operator, $val);
                        break;
                    case 'YEAR':
                        if (!$operator) {
                            $operator = '=';
                        }
                        $this->model = $this->model->whereYear($field, $operator, $val);
                        break;
                    case 'EXISTS':
                        $this->model = $this->model->whereExists($val);
                        break;
                    case 'HAS':
                        $this->model = $this->model->whereHas($field, $val);
                        break;
                    case 'BETWEEN':
                        if (!is_array($val)) {
                            throw new RepositoryException("Input {$val} mus be an array");
                        }
                        $this->model = $this->model->whereBetween($field, $val);
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
        $model = $this->model->updateOrCreate($attributes, $values);

        return $model;
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
