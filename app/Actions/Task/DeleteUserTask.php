<?php

namespace App\Actions\Task;

use App\Models\User;

class DeleteUserTask
{
    public static function handle(User $user, int $id): int
    {
        return $user->tasks()
            ->where('id', $id)
            ->delete();
    }
}
