<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonView extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'lesson_id', 'qty'];

    /**
     * Indicates if the model's ID is auto-incrementing.
     * @var bool
     */
    public $incrementing = false;

    /**
     * lesson - gera relacionamento entre tabelas / traz o a aula da visualizacao
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    /**
     * user - gera relacionamento entre tabelas / traz o user da aula
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
