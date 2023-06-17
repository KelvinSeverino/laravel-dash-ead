<?php

namespace App\Enums;

enum SupportEnum: string
{
    case P = 'Pendente';
    case A = 'Aguardando Aluno';
    case F = 'Finalizado';
}
