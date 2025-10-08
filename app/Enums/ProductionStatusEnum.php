<?php

namespace App\Enums;

enum ProductionStatusEnum: string
{
    case Pending = 'pending';
    case Cutting = 'cutting';
    case Sewing = 'sewing';
    case Finishing = 'finishing';
    case Completed = 'completed';

    /*public function label(): string
    {
        return __('enums.production_status.'.$this->value);
    }*/

    public function color(): string
    {
        return match ($this) {
            self::Pending => 'gray',
            self::Cutting => 'warning',
            self::Sewing => 'info',
            self::Finishing => 'primary',
            self::Completed => 'success',
        };
    }
}
