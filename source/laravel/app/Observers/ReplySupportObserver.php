<?php

namespace App\Observers;

use App\Models\ReplySupport;
use Illuminate\Support\Str;

class ReplySupportObserver
{
    /**
     * Handle the ReplySupport "creating" event.
     */
    public function creating(ReplySupport $reply): void
    {
        $reply->admin_id = auth()->user()->id;
        //$reply->user_id = '6cdff0b8-7d6d-46b7-8522-4d4cfcf85ab8'; //tmp
        $reply->id = Str::uuid();
    }
}
