<?php

namespace App\Repositories\Contracts;

interface EloquentRepository
{
    /**
     * Find a model by its primary key.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function find($id, $columns = ['*']);

    /**
     * Find multiple models by their primary keys.
     *
     * @param  \Illuminate\Contracts\Support\Arrayable|array  $ids
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMany($ids, $columns = ['*']);

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id, $columns = ['*']);

    /**
     * Find a model by its primary key or return fresh model instance.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrNew($id, $columns = ['*']);

    /**
     * Get the first record matching the attributes or instantiate it.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrNew(array $attributes, array $values = []);

    /**
     * Get the first record matching the attributes or create it.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $attributes, array $values = []);

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = []);

    /**
     * create.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function create($attributes);

    /**
     * Save a new model and return the instance.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function forceCreate($attributes);

    /**
     * update.
     *
     * @param  array $attributes
     * @param  mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function update($id, $attributes);

    /**
     * forceCreate.
     *
     * @param  array $attributes
     * @param  mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function forceUpdate($id, $attributes);

    /**
     * delete.
     *
     * @param  mixed $id
     */
    public function delete($id);

    /**
     * Force a hard delete on a soft deleted model.
     *
     * This method protects developers from running forceDelete when trait is missing.
     *
     * @param  mixed $id
     * @return bool|null
     */
    public function forceDelete($id);

    /**
     * Create a new model instance that is existing.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function newInstance($attributes = [], $exists = false);

    /**
     * getModel.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel();

    /**
     * Get a new query builder for the model's table.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery();
}
