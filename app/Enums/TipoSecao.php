<?php

namespace App\Enums;

enum TipoSecao: string
{
    case Carrossel = 'carrossel';
    case Text = 'text';

    public function label()
    {
        return match ($this) {
            Self::Carrossel => 'Carrossel',
            Self::Text => 'Text',
        };
    }

    public function component()
    {
        return match ($this) {
            Self::Carrossel => 'atlas::secoes.carrossel',
            Self::Text => 'atlas::secoes.text',
        };
    }
}


