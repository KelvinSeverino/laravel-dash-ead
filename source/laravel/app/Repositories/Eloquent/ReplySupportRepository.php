<?php

namespace App\Repositories\Eloquent;

use App\Events\SupportReplied;
use App\Models\ReplySupport as Model;
use App\Repositories\ReplySupportRepositoryInterface;

class ReplySupportRepository implements ReplySupportRepositoryInterface
{
    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function createReplyToSupport(array $data): object
    {
        $replySupport = $this->model->create($data);

        event(new SupportReplied($replySupport));

        return $replySupport;
        //return $this->model->create($data);
    }
}
