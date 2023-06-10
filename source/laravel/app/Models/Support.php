<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'description', 'user_id', 'lesson_id'
    ];

    /**
     * user - gera relacionamento entre tabelas / traz o aluno do suporte
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * lesson - gera relacionamento entre tabelas / traz o a aula do suporte
     */
    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
