<?php

namespace App\Enums;

enum ProductionStatusEnum: string
{
    case Pending = 'pending';
    case Cutting = 'cutting';
    case Sewing = 'sewing';
    case Finishing = 'finishing';
    case Completed = 'completed';
}
