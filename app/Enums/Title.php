<?php

namespace  App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Title: string implements HasLabel
{
    case Bishop = 'bishop';
    case Pastor = 'pastor';
    case Reverend = 'reverend';
    case Apostle = 'apostle';
    case Evengelist = 'female';
    case Prophet = 'prophet';
    case Prophetess = 'prophetess';
    case Mr = 'mr';
    case Mrs = 'mrs';
    case Miss = 'miss';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
