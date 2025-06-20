<?php

namespace App\Enums;

enum TaskStatus: string
{
    //
    case InProgress = 'in_progress';
    case Completed = 'completed';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
