<?php

namespace  App\Enums;

use Filament\Support\Contracts\HasLabel;

enum MaritalStatus: string implements HasLabel
{
    case Single = 'single';
    case Married = 'married';
    case Divorced = 'divorced';
    case Separated = 'separated';

    public function getLabel(): ?string
    {
        return $this->name;
    }
}
