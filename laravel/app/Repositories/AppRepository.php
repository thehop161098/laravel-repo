<?php

namespace App\Repositories;

use App\Repositories\Contracts\EloquentRepository as EloquentRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class AppRepository implements EloquentRepositoryContract
{
    protected $sortOrders = array();
    protected $perPage = 50;
    /**
     * $model.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * __construct.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Find a model by its primary key.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public function find($id, $columns = ['*'])
    {
        return $this->newQuery()->find($id, $columns);
    }

    /**
     * Find multiple models by their primary keys.
     *
     * @param  \Illuminate\Contracts\Support\Arrayable|array  $ids
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findMany($ids, $columns = ['*'])
    {
        return $this->newQuery()->findMany($ids, $columns);
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->newQuery()->findOrFail($id, $columns);
    }

    /**
     * Find a model by its primary key or return fresh model instance.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrNew($id, $columns = ['*'])
    {
        return $this->newQuery()->findOrNew($id, $columns);
    }

    /**
     * Get the first record matching the attributes or instantiate it.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrNew(array $attributes, array $values = [])
    {
        return $this->newQuery()->firstOrNew($attributes, $values);
    }

    /**
     * Get the first record matching the attributes or create it.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $attributes, array $values = [])
    {
        return $this->newQuery()->firstOrCreate($attributes, $values);
    }

    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->newQuery()->updateOrCreate($attributes, $values);
    }

    /**
     * create.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function create($attributes)
    {
        return $this->newQuery()->create($attributes);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function forceCreate($attributes)
    {
        return $this->newQuery()->forceCreate($attributes);
    }

    /**
     * update.
     *
     * @param  array $attributes
     * @param  mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function update($id, $attributes)
    {
        return tap($this->findOrFail($id), function ($instance) use ($attributes) {
            foreach ($attributes as $key => $value) {
                $instance->{$key} = $value;
            }
            $instance->saveOrFail();
        });
    }

    /**
     * forceCreate.
     *
     * @param  array $attributes
     * @param  mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     *
     * @throws \Throwable
     */
    public function forceUpdate($id, $attributes)
    {
        return tap($this->findOrFail($id), function ($instance) use ($attributes) {
            $instance->forceFill($attributes)->saveOrFail();
        });
    }

    /**
     * delete.
     *
     * @param  mixed $id
     */
    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    /**
     * Restore a soft-deleted model instance.
     *
     * @param  mixed $id
     * @return bool|null
     */
    public function restore($id)
    {
        return $this->newQuery()->restore($id);
    }

    /**
     * Force a hard delete on a soft deleted model.
     *
     * This method protects developers from running forceDelete when trait is missing.
     *
     * @param  mixed $id
     * @return bool|null
     */
    public function forceDelete($id)
    {
        return $this->findOrFail($id)->forceDelete();
    }

    /**
     * Create a new model instance that is existing.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function newInstance($attributes = [], $exists = false)
    {
        return $this->getModel()->newInstance($attributes, $exists);
    }

    /**
     * getModel.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel()
    {
        return $this->model instanceof Model
            ? clone $this->model
            : $this->model->getModel();
    }

    /**
     * Get a new query builder for the model's table.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function newQuery()
    {
        return $this->model instanceof Model
            ? $this->model->newQuery()
            : clone $this->model;
    }

    public function orderBy($column, $direction = '0')
    {
        if (empty($column)) {
            return $this;
        }
        $direction = empty($direction) ? 'asc' : 'desc';
        $this->sortOrders[] = array($column, $direction);
        return $this;
    }

    public function limit($perPage)
    {
        $perPage = (int) $perPage;
        if ($perPage <= 0) {
            $perPage = $this->perPage;
        }
        $this->perPage = $perPage;
        return $this;
    }
}
