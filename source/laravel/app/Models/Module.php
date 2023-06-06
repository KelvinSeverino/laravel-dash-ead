<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory, UuidTrait;

    protected $fillable = [
        'course_id',
        'name',
    ];

    /**
     * course - gera relacionamento entre tabelas / traz o curso da aula
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * lessons - retorna todas as aulas relacionadas
     */
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }
}
