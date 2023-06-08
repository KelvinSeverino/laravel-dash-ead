<?php

namespace App\Observers;

use App\Models\Lesson;
use Illuminate\Support\Str;

class LessonObserver
{
    /**
     * Handle the Lesson "creating" event.
     */
    public function creating(Lesson $lesson): void
    {
        $lesson->id = Str::uuid();
        $lesson->url = Str::slug($lesson->name);
    }

    /**
     * Handle the Lesson "updating" event.
     */
    public function updating(Lesson $lesson): void
    {
        $lesson->url = Str::slug($lesson->name);
    }
}
