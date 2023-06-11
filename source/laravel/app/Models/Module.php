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
     * Indicates if the model's ID is auto-incrementing.
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
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
