<?php

namespace App\Actions\Task;

use App\DTO\TaskDTO;
use App\Models\User;

class UpdateUserTask
{
    public static function handle(User $user, int $id, TaskDTO $taskDTO): int
    {
        return $user->tasks()
            ->where('id', $id)
            ->update($taskDTO->toArray());
    }
}
