<?php

namespace Backend\Core\Repositories\Interfaces;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * [paginate description]
     * @param  [type] $limit   [description]
     * @param  array  $columns [description]
     * @return [type]          [description]
     */
    public function paginate($limit = null, $columns = ['*']);

    /**
     * [findWhere description]
     * @param  array  $where   [description]
     * @param  array  $columns [description]
     * @return [type]          [description]
     */
    public function findWhere(array $where, $columns = ['*']);
}