<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection as ECollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

abstract class BaseService
{
    protected Model $model;

    protected function __construct(string $modelName)
    {
        $this->model = app($modelName);
    }

    public function all(): ECollection
    {
        return $this->model->all();
    }

    public function allWithPaginate(?int $perPage = 25): LengthAwarePaginator
    {
        return $this->model->paginate($perPage ?? 25)->withQueryString();
    }

    public function create(array|Collection $data): Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array|Collection $data): bool
    {
        return $model->update($data);
    }

    public function delete(Model $model): ?bool
    {
        return $model->delete();
    }
}
