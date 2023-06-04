<?php

namespace App\Repositories\Eloquent;

use App\Models\User as Model;
use App\Repositories\ModuleRepositoryInterface;

class ModuleRepository implements ModuleRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(string $filter = ''): array
    {
        $modules = $this->model
                        ->where(function ($query) use ($filter) {
                            if ($filter) {
                                $query->orWhere('name', 'LIKE', "%{$filter}%");
                            }
                        })
                        ->get();

        return $modules->toArray();
    }

    public function findById(string $id): object|null
    {
        return $this->model->find($id);
    }

    public function create(array $data): object
    {
        return $this->model->create($data);
    }

    public function update(string $id, array $data): object|null
    {
        if(!$module = $this->findById($id)){
            return null;
        }

        $module->update($data);

        return $module;
    }

    public function delete(string $id): bool
    {
        if(!$module = $this->findById($id)){
            return false;
        }

        return $module->delete();
    }
}
