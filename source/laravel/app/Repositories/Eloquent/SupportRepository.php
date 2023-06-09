<?php

namespace App\Repositories\Eloquent;

use App\Models\Support as Model;
use App\Repositories\PaginationInterface;
use App\Repositories\Presenters\PaginationPresenterEloquent;
use App\Repositories\SupportRepositoryInterface;

class SupportRepository implements SupportRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getByStatus(string $status, int $page): PaginationInterface
    {
        //$limit = 15;
        //$skip = ($page - 1) * $limit;
        $supports = $this->model
                        ->where('status', $status)
                        ->with(['user', 'lesson']) //Traz do relacionamento da Model Support com User e Lesson
                        //->skip($skip)
                        //->limit($limit)
                        ->paginate();

        return new PaginationPresenterEloquent($supports);
    }

    public function findById(string $id): object|null
    {
        return $this->model
                    ->with([
                        'user',
                        'lesson',
                        'replies.user',
                        'replies.admin'
                    ])
                    ->find($id);
    }
}
