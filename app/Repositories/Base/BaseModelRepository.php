<?php

namespace App\Repositories\Base;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModelRepository
{
    /**
     * @var Model $model
     */
    private Model $model;

    public function __construct(

    )
    {
        $this->initialize();
    }

    public abstract function getModel(): string;

    public function initialize()
    {
        $this->model = app()->make($this->getModel());
    }

    /**
     * @return Model
     */
    public function getModelClone(): Model
    {
        return clone $this->model;
    }

    /**
     * @param integer $id
     * @return Model
     */
    public function find(int $id): Model
    {
        return $this->getModelClone()->newQuery()->findOrFail($id);
    }

    /**
     * @param array $columns
     * @return Collection
     */
    public function get(array $columns = ['*']): Collection
    {
        return $this->getModelClone()->newQuery()->get($columns);
    }


    /**
     * @param [type] $method
     * @param [type] $parameters
     * @return void
     */
    public function __call($method, $parameters): mixed
    {
        return $this->model->$method(...$parameters);
    }
}