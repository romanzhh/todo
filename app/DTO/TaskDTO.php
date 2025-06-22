<?php

namespace App\DTO;

use App\Enums\TaskStatus;
use Spatie\LaravelData\Data;

class TaskDTO extends Data
{
    public function __construct(
        public string $title,
        public string $description,
        public TaskStatus $status,
    ) {}
}
