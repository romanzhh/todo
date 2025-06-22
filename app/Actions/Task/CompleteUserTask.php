<?php

namespace App\Actions\Task;

use App\Enums\TaskStatus;
use App\Models\User;

class CompleteUserTask
{
    public static function handle(User $user, int $id): bool
    {
        return $user->tasks()
            ->where('id', $id)
            ->update(['status' => TaskStatus::Completed]);
    }
}
