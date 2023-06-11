<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplySupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'admin_id', 'support_id', 'description'
    ];

    public $incrementing = false;

    protected $table = 'reply_support';

    /**
     * admin - gera relacionamento entre tabelas / traz o professor/admin da resposta
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * user - gera relacionamento entre tabelas / traz o aluno da resposta
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * support - gera relacionamento entre tabelas / traz o suporte da resposta
     */
    public function support()
    {
        return $this->belongsTo(Support::class);
    }
}
