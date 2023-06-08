<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'module_id', 'name', 'description', 'url', 'video'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
    ];

    /**
     * module - gera relacionamento entre tabelas / traz o modulo da aula
     */
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
