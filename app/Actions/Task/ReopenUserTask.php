<?php

namespace App\Actions\Task;

use App\Enums\TaskStatus;
use App\Models\User;

class ReopenUserTask
{
    public static function handle(User $user, int $id): bool
    {
        return UpdateUserTaskStatus::handle($user, $id, TaskStatus::InProgress);
    }
}
