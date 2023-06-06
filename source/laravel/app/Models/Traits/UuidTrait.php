<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

trait UuidTrait
{
    //Reescrevendo o metodo, com mesma finalidade das observers para gerar hash ID
    public static function booted()
    {
        static::creating(function (Model $model) {
            //Gerando ID Hash dinamicamente com o getKeyName, ira pegar o ID mesmo tendo outro nome na coluna
            $model->{$model->getKeyName()} = Str::uuid();
        });
    }
}
