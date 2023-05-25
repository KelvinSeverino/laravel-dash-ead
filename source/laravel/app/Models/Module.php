<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
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
