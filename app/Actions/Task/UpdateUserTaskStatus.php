<?php

namespace App\Actions\Task;

use App\Enums\TaskStatus;
use App\Models\User;

class UpdateUserTaskStatus
{
    public static function handle(User $user, int $id, TaskStatus $status): int
    {
        return $user->tasks()
            ->where('id', $id)
            ->update(['status' => $status]);
    }
}
