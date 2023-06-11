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
        //$reply->admin_id = auth()->user()->id;
        $reply->id = Str::uuid();
    }
}
