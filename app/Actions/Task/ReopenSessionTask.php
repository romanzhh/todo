<?php

namespace App\Actions\Task;

use App\Enums\TaskStatus;

class ReopenSessionTask
{
    public static function handle(string $id): bool
    {
        return UpdateSessionTaskStatus::handle($id, TaskStatus::InProgress);
    }
}
