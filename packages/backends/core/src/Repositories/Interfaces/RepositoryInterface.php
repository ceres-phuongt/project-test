<?php

namespace Backend\Core\Repositories\Interfaces;

interface RepositoryInterface
{
    public function make(array $with = []);
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
     * @param  array  $select [description]
     * @return [type]          [description]
     */
    public function paginate($limit = null, $select = ['*']);

    /**
     * [findWhere description]
     * @param  array  $where   [description]
     * @param  array  $select [description]
     * @return [type]          [description]
     */
    public function findWhere(array $attributes, $select = ['*']);

    /**
     * [getFirstBy description]
     * @param  array  $column  [description]
     * @param  array  $where   [description]
     * @param  array  $select [description]
     * @return [type]          [description]
     */
    public function getFirstBy(array $condition = [], array $select = ['*']);

    /**
     * [updateOrCreate description]
     * @param  array  $attributes [description]
     * @param  array  $values     [description]
     * @return [type]             [description]
     */
    public function updateOrCreate(array $attributes, array $values = []);

    public function pluck($column, $key = null, array $condition = []);
}
