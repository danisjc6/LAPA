<?php

namespace App\Enums;

enum StatusUser: string
{
    case Pendente = 'pendente';
    case Ativo = 'ativo';
    case Bloqueado = 'bloqueado';

    public function label(): string
    {
        return match ($this) {
            self::Pendente => 'Pendente',
            self::Ativo => 'Ativo',
            self::Bloqueado => 'Bloqueado',
        };
    }

    public function classes(): string
    {
        return match ($this) {
            self::Pendente =>
                'bg-amber-50 text-amber-700 ring-amber-600/20',

            self::Ativo =>
                'bg-emerald-50 text-emerald-700 ring-emerald-600/20',

            self::Bloqueado =>
                'bg-red-50 text-red-700 ring-red-600/20',
        };
    }
}
